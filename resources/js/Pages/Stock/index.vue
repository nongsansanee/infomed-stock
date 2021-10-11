<template>
    <AppLayout>
        เลือกคลังพัสดุ
       
        <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
            <option v-for="(stock) in  $page.props.stocks" :key=stock.id value="{{stock.id}}">{{stock.stockname}}</option>
        </select>
        <li  v-for="(stock_item) in  $page.props.stock_items" :key=stock_item.id  >
            {{stock_item.item_name}}
        </li>
     <!-- {{$page.props.stock_items}} -->
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
        stocks:Array,
        stock_items:Array,
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
