<template>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div v-bind:class="'form-group' + (error.content !== null ? ' has-error' : '' )">
                            <label for="content">Add a Note</label>
                            <input type="text" class="form-control" id="content" v-model="content" @keyup.enter="create" placeholder="Add a note">
                            <div class="help-block" v-if="error.content">
                                <div class="help-block">
                                    You must add content to your note.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default pull-right" @click.prevent="create">Add</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" v-if="loaded">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" >Your {{ notebook.title }} Notebook <a href="/notebooks" class="pull-right">Go back</a></div>

                    <div class="panel-body">
                        <div v-if="notes.length">
                            <ul class="list-group">
                                <li id="notes" class="list-group-item" v-for="(note, index) in notes">
                                    <p class="note-content">{{ note.content }}</p>
                                    <a v-bind:href="'/notebooks/' + notebook.uid + '/notes/' + note.uid + '/edit'" class="edit-link"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" @click.prevent="destroy(index, note.uid)" class="delete-link"><span class="glyphicon glyphicon-remove"></span></a>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <p>You currently don't have any notes saved in this Notebook.</p>
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
                content: null,
                notes: [],
                error: {
                    content: null
                }
            }
        },
        props: {
            notebook: {
                uid: null,
                title: null
            }
        },
        methods: {
            create() {
                return this.$http.post('/notebooks/' + this.notebook.uid + '/notes/create', {
                    content: this.content
                }).then((response) => {
                    this.notes.push({
                        content: this.content,
                        uid: response.body
                    });
                    this.content = '';
                }, () => {
                    this.error.content = true;
                });
            },
            getNotes() {
                this.$http.get('/notebooks/' + this.notebook.uid + '/index').then((response) => {
                    this.notes = response.body;
                    this.loaded = true;
                });
            },
            destroy(index, uid) {
                this.notes.splice(index, 1);
                this.$http.delete('/notebooks/' + this.notebook.uid + '/notes/' + uid + '/delete');
            }
        },
        mounted () {
            this.getNotes();
        }

    }
</script>
