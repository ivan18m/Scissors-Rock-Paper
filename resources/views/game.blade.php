@extends('layouts.app')

@section('title')
 | Play
@endsection

@section('content')
    <v-container>
        <v-layout align-center justify-center mb-5 mt-2>
            <h1>Pick</h1>
        </v-layout>

        <v-layout align-center justify-center row fill-height wrap>
            <v-flex v-for="element in elements" :key="element.id" xs12 sm4 px-5>
                <v-btn block color="primary" v-on:click="playElement(element.id, element.name)">@{{element.name}}</v-btn>
            </v-flex>
        </v-layout>

        <v-layout justify-center mt-5 v-show="opponentElement.length > 0">
            <h1>You played: @{{myElement}}</h1>
        </v-layout>

        <v-layout justify-center mt-2 v-show="opponentElement.length > 0">
            <h1>Opponent played: @{{opponentElement}}</h1>
        </v-layout>

        <v-layout justify-center mt-5 wrap>
            <v-flex xs12 justify-center>
                <v-alert block :value="win" color="success">
                    <h1 class="text-xs-center">WIN</h1>
                </v-alert>
                <v-alert :value="tie" color="info">
                    <h1 class="text-xs-center">TIE</h1>
                </v-alert>
                <v-alert :value="lose" color="error">
                    <h1 class="text-xs-center">LOSE</h1>
                </v-alert>
            </v-flex>
        </v-layout>

        <v-layout wrap justify-center>
            <v-flex xs12 md6>
                <v-alert :value="alert" color="error" outline transition="scale-transition">
                    <p class="text-xs-center" v-for="err in errs">@{{ err }}</p>
                </v-alert>
            </v-flex>
        </v-layout>

    </v-container>
@endsection

@section('script')
<script>
    new Vue({
        el: "v-app",
        data: {
            processing: false,
            elements: [],
            myElement: "",
            opponentElement: "",  
            win: false,
            tie: false,
            lose: false,
            errs: {},
            alert: false
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

            resetVars(elName) {
                this.win = false;
                this.tie = false;
                this.lose = false;
                this.myElement = elName;
                this.opponentElement = "";
                this.errs = {};
                this.alert = false;
            },

            playElement(id, elName) {
                if (this.processing) {
                    return;
                } 
                this.processing = true;
                this.resetVars(elName);

                var config = {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded;charset=utf-8;"
                    }
                };

                axios.get("/api/game?id="+id, config)
                    .then(response => {
                        var result = response.data.result.toLowerCase();
                        if(result == "win") {
                            this.win = true;
                        }
                        else if(result == "tie") {
                            this.tie = true;
                        }
                        else if(result == "lose") {
                            this.lose = true;
                        }
                        this.opponentElement = response.data.element.name;
                        this.processing = false;
                    })
                    .catch(error => {
                        this.errs = error.response.data.errors;
                        this.alert = true;
                        this.processing = false;
                    });
            }
        },
        created() {
            this.fetchElements();
        }
    });
</script>
@endsection