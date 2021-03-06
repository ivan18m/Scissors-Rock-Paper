@extends('layouts.app')

@section('title')
 | Create element
@endsection

@section('content')
    <v-container>
        <v-layout justify-center wrap>
                <v-flex xs12>
                    <div class="text-xs-center"><v-btn href="/element/create">new element</v-btn></div>
                </v-flex>
                
                <v-list two-line subheader>
                    <v-subheader>Elements</v-subheader>
                    <template v-for="(element, index) in elements">
                        <v-list-tile :key="index">
                            <v-list-tile-content>
                                <v-btn color="primary" block :href="'/element/'+element.id+'/edit'">@{{element.name}}</v-btn>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-btn flat fab v-on:click="deleteElement(element.id, index)">
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                        </v-list-tile>
                    </template>
                </v-list>

        </v-layout>
    </v-container>
@endsection

@section('script')
<script>
    new Vue({
        el: "v-app",
        data: {
            elements: [],
        },
        methods: {
            fetchElements() {
                var config = {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded;charset=utf-8;"
                    }
                };
                axios.get("/api/element", null, config).then(response => {
                    this.elements = response.data;
                });
            },
            deleteElement(id, index) {
                if (this.processing === true) {
                    return;
                } 
                this.processing = true;
                if(!confirm("Delete " + this.elements[index].name + "?")) {
                    this.processing = false;
                    return;
                }

                var config = {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded;charset=utf-8;"
                    }
                };
                axios.delete("/api/element/"+id, null, config).then(response => {
                    this.elements.splice(index, 1);
                    this.processing = false;
                })
            }
        },
        created() {
            this.fetchElements();
        }
    });
</script>
@endsection





