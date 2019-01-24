<template>
    <div class="heart">
        <span v-for="i in count" :key="i">

            <img v-bind:src="i<canuse ? full_src : empty_src " @click="useHeart($event)" width="10%" alt="">

            <div v-if="i==4" class="vertical-line"></div>
            <div v-else-if="i==8" class="vertical1-line"></div>
            <div v-else-if="i<12" class="line"></div>

        </span>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        props:['canuse'],

        data(){
            return {
                count:12,
                empty_src:'/images/aixin1.png',
                full_src:'/images/aixin.png'
            };
        },
        methods:{
            useHeart:function(event){
                this.$http('/api/').then(response=>{
                    console.log(response.data)
                }).catch(reason => {
                    console.log(reason);
                });
                if(event.currentTarget.getAttribute("src") === this.full_src) return;
                event.currentTarget.setAttribute("src",this.full_src);
            }
        },
    }
</script>
