<template>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div v-bind:class="'form-group' + (error.content !== null ? ' has-error' : '' )">
                            <label for="content">Add a Note</label>
                            <input type="text" class="form-control" id="content" v-model="content" placeholder="Add a note">
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

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" >Your {{ notebookTitle }} Notebook <a href="/notebooks" class="pull-right">Go back</a></div>

                    <div class="panel-body">
                        <div v-if="notes.length">
                            <ul class="list-group">
                                <li id="notes" class="list-group-item" v-for="note in notes">
                                    <p class="note-content">{{ note.content }}</p>
                                    <a v-bind:href="'/notebooks/' + notebookUid + '/note/' + note.uid + '/edit'" class="edit-link"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" @click.prevent="destroy(note.uid)" class="delete-link"><span class="glyphicon glyphicon-remove"></span></a>
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
    import {reverse} from '../filters.js'
    export default {

        data() {
            return {
                content: null,
                notes: [],
                error: {
                    content: null
                }
            }
        },
        props: {
            notebookUid: null,
            notebookTitle: null
        },
        methods: {
            create() {
                return this.$http.post('/notebooks/' + this.notebookUid + '/note/create', {
                    content: this.content
                }).then((response) => {
                    // user can add an additional note to view by clicking the Add button straight after successful post is made.
                    // Not going to implement check, as not really a security problem, mainly a UI/UX issue. Note, the second 'submission'
                    // does not make it to the database, only adds to the client notes array below.

                    // If user adds item and, clicks on note and then clicks back button in browser, new note is absent until user refreshes browser.
                    // add to top of array
                    this.notes.push({
                        content: this.content,
                        uid: response.body
                    });

                    this.content = '';
                    // Alternative: undoes ordering after user has added new note.
                    //this.getNotes();
                }, () => {
                    this.error.content = true;
                });
            },
            getNotes() {
                this.$http.get('/notebooks/' + this.notebookUid + '/index').then((response) => {
                    this.notes = response.body;
                });
            },
            reverse,
            destroy(uid) {
                this.$http.delete('/notebooks/' + this.notebookUid + '/note/' + uid + '/delete').then((response) => {
                    this.getNotes();
                }, () => {
                    console.log('error');
                });
            }
        },
        mounted () {
            this.getNotes();
        }

    }
</script>
