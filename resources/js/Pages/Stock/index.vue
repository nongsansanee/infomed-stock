<template>
    <AppLayout>
        <div class=" w-full  bg-blue-100 p-2 rounded-md ">
            <div class="bg-blue-800 text-white text-xl text-center ">
                {{$page.props.unit.unitname}}
            </div>
            <div class="mt-3" >
                <label for="">เลือกคลังพัสดุ</label> 
            </div>
            <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                <option v-for="(stock) in  $page.props.stocks" :key=stock.id value="{{stock.id}}">{{stock.stockname}}</option>
            </select>
           
        <!-- {{$page.props.stock_items}} -->
        </div>
        <!-- show stock items -->
        <!-- <div class="w-full mt-3 p-2 bg-blue-400 rounded-md">
            <div  v-for="(stock_item) in  $page.props.stock_items" :key=stock_item.id
            class=" mt-2 bg-green-50 rounded-sm">
                    {{stock_item.item_code}} {{stock_item.item_name}}
            </div>
            
        </div> -->

        <!-- EX3 Card -->
 <!-- <h4 class=" mt-3 text-red-600 text-2xl text-center">***click ที่รายการที่ต้องการเบิก***</h4> -->
    <div class="w-full mt-3 p-2  ">
  
      <div v-for="(stock_item,key) in $page.props.stock_items" :key=stock_item.id
            class="w-full bg-purple-100  mt-3 border-2 border-purple-300 rounded-lg lg:max-w-full lg:flex">
        
        <div
          class="flex-none h-32 overflow-hidden text-center  bg-cover rounded-t lg:h-auto lg:w-36 lg:rounded-t-none lg:rounded-l"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-2o" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        
        <div
          class="w-full  leading-normal  border-b border-l border-r border-gray-200 rounded-b lg:border-l-0 lg:border-t lg:border-gray-200 lg:rounded-b-none lg:rounded-r"
        >
            <div class=" mb-2">
            
                <div class="p-2 text-md font-bold text-gray-900">
                    {{key+1}}.
                    SAP:{{stock_item.item_code}}
                    <label for="" class="text-blue-600">{{stock_item.item_name}}</label>
                    (หน่วย: กล่อง{{stock_item.unit_count_id}})
                     <Link :href="route('stock-item',stock_item.id)">
                    <span
                        class="inline-flex text-md font-semibold leading-5 text-green-800 bg-green-200 rounded-lg"
                    >
                        ประวัติการเบิก
                    </span>
                    </Link>
                </div>
               
            
                <div class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                    <div class=" ml-2"> จำนวนคงเหลือ : </div>
                    <div class=" ml-2 text-red-600">{{stock_item.item_receive}}</div> 
                    <div class=" ml-2"> วันหมดอายุ : </div>
                    <div class=" ml-2 text-blue-600">{{stock_item.date_expire}}</div> 
                    <div class=" ml-2"> วันที่รับเข้า : </div>
                    <div class=" ml-2 text-blue-600">{{stock_item.date_receive}}</div> 
                     <div class=" ml-2"> Cat.No/Lot.No : </div>
                    <div class=" ml-2 text-blue-600">{{stock_item.catalog_number}}/{{stock_item.lot_number}}</div> 
                </div>
              
             
                <div class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                    <div class=" m-2">
                        <label for="">วันที่เบิก:</label>
                        <input type="date" name="" id=""
                            class="w-full px-12 py-2 border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                    </div>
                     <div class=" m-2">
                        <label for="">จำนวน:</label>
                        <input type="number" name="" id=""
                         class="w-full px-12 py- border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                     </div>

                     
                </div>

                <div class="flex flex-col lg:flex-row px-2 py-2  ">
                    <!-- <button
                        class="px-3 py-1  text-sm text-gray-700 bg-gray-400 rounded-md hover:bg-gray-300 focus:outline-none"
                    >
                        Cancel
                    </button> -->
                    <button
                        class=" flex justify-center px-8 py-1   text-sm  text-white bg-green-600 rounded-md hover:bg-green-400 focus:outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                       
                    </button>
                </div>
            </div>
          <!-- <div class="flex items-center">
           
            <div class="text-sm">
              <p class="leading-none text-gray-900">Jonathan Reinink</p>
              <p class="text-gray-600">Aug 18</p>
            </div>
          </div> -->
           
        </div>
       
      </div>
    
    </div>
   

     

    </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        Link,
    },
    props:{
        stocks:Array,
        stock_items:Array,
        unit:Array,
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
