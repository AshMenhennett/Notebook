<template>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div v-bind:class="'form-group' + (error.title !== null ? ' has-error' : '')">
                            <label for="title">Create a new Notebook</label>
                            <input type="text" class="form-control" id="title" v-model="title" @keyup.enter="create" placeholder="Name your new notebook">
                            <div class="help-block" v-if="error.title">
                                You must supply a title for your notebook.
                            </div>
                        </div>

                        <button class="btn btn-default pull-right" @click.prevent="create">Create</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" v-if="loaded">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" v-cloak>
                    <div class="panel-heading">Your Notebooks</div>

                    <div class="panel-body">
                        <div v-if="notebooks.length">
                            <button class="btn btn-default btn-sm pull-right" @click="order()"><span v-bind:class="'glyphicon glyphicon-sort-by-attributes' + (orderedBy === 'desc' ? '' : '-alt')"></span> {{ (orderedBy === 'asc' ? 'Newest' : 'Oldest') }}</button>
                            <br />
                            <br />
                            <ul class="list-group">
                                <li id="notebooks" class="list-group-item" v-for="(notebook, index) in notebooks">
                                    <a class="notebook-title" v-bind:href="'/notebooks/' + notebook.uid + '/show'">{{ notebook.title }}</a>
                                    <a v-bind:href="'/notebooks/' + notebook.uid + '/edit'" class="edit-link"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" @click.prevent="destroy(index, notebook.uid)" class="delete-link"><span class="glyphicon glyphicon-remove"></span></a>
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
    export default {

        data() {
            return {
                loaded: false,
                title: null,
                notebooks: [],
                error: {
                    title: null
                },
                orderedBy: 'asc'
            }
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
                            uid: response.body
                        });
                    } else {
                        this.notebooks.unshift({
                            title: this.title,
                            uid: response.body
                        });
                    }
                    this.title = '';
                }, () => {
                    this.error.title = true;
                });
            },
            getNotebooks() {
                this.$http.get('/notebooks/index').then((response) => {
                    this.notebooks = response.body;
                    this.loaded = true;
                });
            },
            order() {
                this.notebooks.reverse();
                this.orderedBy = (this.orderedBy === 'asc' ? 'desc' : 'asc');
            },
            destroy(index, uid) {
                this.notebooks.splice(index, 1);
                this.$http.delete('/notebooks/' + uid + '/delete');
            }
        },
        mounted () {
            this.getNotebooks();
        }

    }
</script>
