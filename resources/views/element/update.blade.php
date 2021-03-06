@extends('layouts.app')

@section('title')
 | Edit element
@endsection

@section('content')
    <v-container>
        <v-layout justify-center wrap>
            <v-flex xs12>
                <h1 class="text-xs-center">Edit an element</h1>
            </v-flex>
            <v-flex xs12 sm8 md6 lg4>
                <v-card class="elevation-3" >
                    <v-card-text>
                        <v-layout wrap justify-center>
                            <v-flex xs8>
                                <v-text-field name="name" label="Name" type="text"
                                    data-vv-name="name" data-vv-delay="800" v-model="element.name"
                                    v-validate="'alpha|required'" required autofocus
                                    :error-messages="errors.collect('name')">
                                </v-text-field>
                            </v-flex>
                            <v-flex xs8>
                                <v-select
                                        v-model="element.strengths"
                                        :items="elements"
                                        item-value="id"
                                        item-text="name"
                                        label="Strengths"
                                        multiple
                                        chips
                                        hint="This element will win against"
                                        persistent-hint
                                        >
                                </v-select>
                            </v-flex>
                            <v-flex xs8>
                                <v-select
                                        v-model="element.weaknesses"
                                        :items="elements"
                                        item-value="id"
                                        item-text="name"
                                        label="Weaknesses"
                                        multiple
                                        chips
                                        hint="This element will lose against"
                                        persistent-hint
                                        >
                                </v-select>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-actions>
                        <v-layout wrap justify-center>
                            <v-btn color="primary" v-on:click="submit">Edit</v-btn>
                        </v-layout>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.min.js"></script>
<script>
    Vue.use(VeeValidate);
    new Vue({
        el: "v-app",
        data: {
            processing: false,
            element: {
                id: {{$element->id}},
                name: "{{$element->name}}",
                strengths: {{$element->strengths}},
                weaknesses: {{$element->weaknesses}}
            },
            elements: [],
            errs: {}
        },
        methods: {
            fetchElements() {
                var config = {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded;charset=utf-8;"
                    }
                };
                axios.get("/api/element", config).then(response => {
                    this.elements = response.data;
                    var len = this.elements.length;
                    for(var i = 0; i < len; ++i) {
                        if(this.elements[i].id == this.element.id) {
                            this.elements.splice(i, 1);
                            break;
                        }
                    }
                });
            },
            submit() {
                if (this.processing === true) {
                    return;
                } 
                this.processing = true;

                this.$validator.validate().then(valid => {
                    if (!valid) {
                        alert('Form not filled correctly');
                        this.processing = false;
                        return;
                    }
                    
                    this.element.strengths.forEach(strength => {
                        if(this.element.weaknesses.includes(strength)) {
                            alert("Error\nStrength and weakness can't be the same");
                            this.processing = false;
                            return;
                        }
                    });

                    var config = {
                        headers: {
                            "Content-Type": "application/json;charset=utf-8;"
                        }
                    };
                    axios.put("/api/element/"+this.element.id, this.element, config)
                        .then(response => {
                            window.location = '/element';
                            this.processing = false;
                        })
                        .catch(error => {
                            this.errs = error.response.data.errors;
                            this.alert = true;
                            this.processing = false;
                        });
                });
            }
        },
        created() {
            this.fetchElements();
        }
    });
</script>
@endsection