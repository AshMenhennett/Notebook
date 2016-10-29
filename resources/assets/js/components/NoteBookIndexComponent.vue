<template>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div v-bind:class="'form-group' + (error.title !== null ? ' has-error' : '')">
                            <label for="title">Create a new Notebook</label>
                            <input type="text" class="form-control" id="title" v-model="title" placeholder="Name your new notebook">
                            <div class="help-block" v-if="error.title">
                                You must supply a title for your notebook.
                            </div>
                        </div>

                        <button class="btn btn-default pull-right" @click.prevent="create">Create</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" v-cloak>
                    <div class="panel-heading">Your Notebooks</div>

                    <div class="panel-body">
                        <div v-if="notebooks.length">
                            <button class="btn btn-default btn-sm pull-right" @click="order(notebooks)"><span v-bind:class="'glyphicon glyphicon-sort-by-attributes' + (orderedBy === 'asc' ? '-alt' : '')"></span> {{ (orderedBy === 'asc' ? 'Desc.' : 'Asc.') }}</button>
                            <br />
                            <br />
                            <ul class="list-group">
                                <li class="list-group-item" v-for="notebook in notebooks">
                                    <a class="notebook-title" v-bind:href="'/notebooks/' + notebook.uid + '/show'">{{ notebook.title }}</a>
                                    <div class="created-at">Created {{ moment(notebook.created_at).fromNow() }}</div>
                                    <a v-bind:href="'/notebooks/' + notebook.uid + '/edit'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                    <a href="#" @click.prevent="destroy(notebook.uid)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <p>You currently don't have any notebooks saved.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {reverse} from '../filters.js'
    export default {

        data() {
            return {
                title: null,
                notebooks: [],
                error: {
                    title: null
                },
                orderedBy: 'asc'
            }
        },
        props: {

        },
        methods: {
            create() {
                return this.$http.post('/notebooks/create', {
                    title: this.title
                }).then((response) => {
                    // If user adds item and, clicks on notebook and then clicks back button in browser, new notebook is absent until user refreshes browser.
                    // add to either top or bottom of array, depending on user selected ordering
                    if (this.orderedBy === 'asc') {
                        this.notebooks.push({
                            title: this.title,
                            uid: response.body,
                            created_at: response.body.created_at
                        });
                    } else {
                        this.notebooks.unshift({
                            title: this.title,
                            uid: response.body,
                            created_at: response.body.created_at
                        });
                    }

                    // Alternative: undoes ordering after user has added new notebook.
                    //this.getNotebooks();
                }, () => {
                    this.error.title = true;
                });
            },
            getNotebooks() {
                this.$http.get('/notebooks/index').then((response) => {
                    this.notebooks = response.body;
                });
            },
            order(notebooks) {
                this.notebooks = reverse(notebooks);
                this.orderedBy = (this.orderedBy === 'asc' ? 'desc' : 'asc');
            },
            moment(... args) {
                return moment(... args);
            },
            reverse,
            destroy(uid) {
                this.$http.delete('/notebooks/' + uid + '/delete').then((response) => {
                    this.getNotebooks();
                }, () => {
                    console.log('error');
                });
            }
        },
        mounted () {
            this.getNotebooks();
        }

    }
</script>
