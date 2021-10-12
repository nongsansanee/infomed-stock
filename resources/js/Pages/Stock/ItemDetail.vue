<template>
     <AppLayout>
         Wait Please.
         {{$page.props.stock_item}}
     </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props:{
        stock_item:Array,
     },
    data(){
        return{
           
        //    stocks:[
		// 		{code:1,name:'aa' },
		// 		{code:2,name:'bb' },	
		// 		{code:3,name:'cc' },		
		// 	],
        }
    },

    // setup() {
    
    //     return { };
    // },
}

</script>