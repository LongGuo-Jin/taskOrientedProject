<style scoped>

    .color-check-box {
        display: block;
        position: relative;
        margin-right: 30px;
        margin-bottom: 30px;
        cursor: pointer;
        font-size: 18px;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border-radius: 2px;
    }

    .color-check-box input {
        position: absolute;
        z-index: 99;
        opacity: 0;
        cursor: pointer;
        height: 20px;
        width: 20px;
    }


    .color-check-box .checkmark:after {
        left: 9px;
        top: 5px;
        width: 8px;
        height: 13px;
        border: solid #000000;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .color-check-box input:checked ~ .checkmark:after {
        display: block;
    }

    .checkmark:after {
        content:"";
        position:absolute;
        display: none;
    }

</style>
<template>
    <div>
        <input v-model="color" type="hidden" name="avatarColor">
        <input v-model="colorValue" type="hidden" name="avatarColorValue">

        <div v-for="i in 3" :key="i">
            <div style="display: flex">
                <div v-for="j in 8" :key="j">
                    <div class="color-check-box" >
                        <div v-if="i-1===row && j-1 === col">
                            <input type="radio" name="radio" placeholder="" @click="()=>{ColorSelect(j-1,i-1)}"  checked >
                            <span class="checkmark" v-bind:style="{backgroundColor: colors[j-1][i-1]}"></span>
                        </div>
                        <div v-else>
                            <input type="radio" name="radio" placeholder="" @click="()=>{ColorSelect(j-1,i-1)}" >
                            <span class="checkmark" v-bind:style="{backgroundColor: colors[j-1][i-1]}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:  ['cov'],
        methods: {
            ColorSelect(j,i) {
                this.color = this.colors[j][i];
                this.colorValue = 8 * i + j * 1;
            }
        },
        computed: {

        },
        mounted() {

            if (this.cov) {
                this.colorValue = this.cov;
                this.col = (this.colorValue % 8);
                this.row = ((this.colorValue-this.col) / 8);
                this.color = this.colors[this.col][this.row];
            }
        },
        data() {
            return {
                colors: [ ['#FF0000','#FF000099','#FF000044'],
                    ['#d4b04d','#d4b04d99','#d4b04d44'],
                    ['#e5ff08','#e5ff0899',"#e5ff0844"],
                    ['#08ff0f','#08ff0f99','#08ff0f44'],
                    ['#4a6f4b','#4a6f4b99','#4a6f4b44'],
                    ['#277af7','#277af799','#277af744'],
                    ['#2a27f7','#2a27f799','#2a27f744'],
                    ['#f72787','#f7278799','#f7278744'],],
                row:0,
                col:0,
                colorValue:0,
                color:''
            }
        }
    }
</script>