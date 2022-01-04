<template>
    <AppLayout>

          <!--Header Alert-->
            <div v-if="$page.props.flash.status=='success'" 
                class="alert-banner  fixed  right-0 m-2 w-5/6 md:w-full max-w-sm ">
                <input type="checkbox" class="hidden" id="banneralert">
                
                <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-300 shadow rounded-md text-green-800 font-bold" title="close" for="banneralert">
                 {{ $page.props.flash.msg }}
                   <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </label>
            </div>

    
        <div class=" w-full  bg-blue-100 p-2 rounded-md ">
            <div class="bg-blue-800 text-white text-xl text-center ">
                {{unit.unitname}}
            </div>
            <div class="mt-3" >
                <label for="">เลือกคลังพัสดุ</label> 
            </div>
            <select name="" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                <option v-for="(stock) in  stocks" :key=stock.id value="{{stock.id}}">{{stock.stockname}}</option>
            </select>
           
       
        </div>
      

    <h1 class=" m-3 text-center" >ข้อมูลจำนวนคงเหลือ ณ วันที่ปัจจุบัน {{sysdate_thai}}</h1>

    <!-- item order -->
  
    <div class=" flex text-right px-6 justify-end  ">
     
        <div class="flex ">
            <p class=" text-sm py-2"> กดที่ตะกร้าเพื่อยืนยันการสั่งซื้อ</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div >
        <div  class="">
            <button v-if="show_preorder"
                 class="transition duration-500 ease-in-out bg-red-600 hover:bg-red-400 transform hover:-translate-y-1 hover:scale-110 inline-flex px-2   text-lg font-semibold leading-5 text-white  rounded-full"
                 v-on:click="showPreorder"
                 >
                {{form.preview_orders.length}}
            </button>
              
        </div>
        
        
    </div>


      <!--Toast-->
    <div v-if="show_preorder" 
        class="alert-banner z-20 fixed top-60 ml-20 shadow-lg md:w-full max-w-md">
        
        <label for="" class=" flex items-start justify-between w-full p-1 bg-yellow-200  shadow-lg text-yellow-900 font-bold" title="close" >
            รายการพัสดุที่ต้องการสั่งซื้อ
        </label>

        <input type="checkbox" class="hidden" id="previeworder" v-on:click="closePreviewOrder">
       
        <label v-for="(preview_order,index) in preview_orders" :key=preview_order.id
            class="close cursor-pointer flex items-start justify-between w-full p-1 bg-yellow-100 shadow-lg text-sm text-yellow-900" title="close" for="previeworder">
            {{index+1}}.{{preview_order.item_name}} จำนวน {{preview_order.unit}} x {{preview_order.price}}  เป็นเงิน {{preview_order.total}} บาท
        
        </label>
        <label for="" class=" flex items-start justify-between w-full p-1 bg-yellow-100  shadow-lg text-yellow-800 font-bold">
             รวม  {{sumPay}} บาท</label>
         <button
            class="  w-full flex justify-center py-2  text-sm  text-yellow-900 font-bold bg-yellow-300 hover:bg-yellow-200 focus:outline-none"
            v-on:click="createOrder()"
            >
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                    </svg>
                    สร้างใบสั่งซื้อ
        </button>
     
    </div>
    <!-- test -->
    <!-- display card -->
    <!-- {{stock_items}} -->
      <div>
        
        <!-- {{form.preview_orders.length}}//
         {{form.preview_orders}} -->
     </div>

     <OrderItem v-for="(stock_item,index) in stock_items" :key=stock_item.id 
        :index="index" :stock_item="stock_item" :businesses="businesses" />
    <!-- Start  display card -->
    <!-- <div class="w-full  p-2  ">
  
        <div v-for="(stock_item,index) in stock_items" :key=stock_item.id
                class="w-full   bg-red-100 border-2 border-red-200 mt-3  rounded-lg lg:max-w-full lg:flex lg:flex-col">
                 <div class="flex ml-2"> {{index+1}}. 
                    <p class=" ml-2 ">  {{stock_item.item_code}}:{{stock_item.item_name}}</p> 
                    <p class=" ml-2 text-red-600" >
                             <span  
                                class="inline-flex px-2  text-lg font-semibold leading-5  rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            {{stock_item.item_sum}}
                            </span>
                    </p> 
                </div>
                <div class="flex ml-6">
                     <p class=" ml-2 text-xs ">  {{stock_item.checkin_last.profile['catalog_number']}}/{{stock_item.checkin_last.profile['lot_number']}}</p> 
                </div>
                <div  class="flex ml-6">
                     <div class=" w-1/4 py-2 px-2 text-right"> จำนวนสั่งซื้อ:</div>
                     <div class=" w-3/4 ">
                     <input type="number"   placeholder="จำนวนสั่งซื้อ"   :ref="'item-'+stock_item.id" 
                            class="block w-full mt-1 border-gray-400 rounded-md ">
                     </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Cat.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="stock_item.checkin_last.profile['catalog_number']" v-bind:ref="'cat_no-'+stock_item.id"
                            class="block w-full mt-1   border-gray-400 rounded-md ">
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> Lot.No:</div>
                    <div class=" w-3/4 ">
                      <input type="text"  v-model="stock_item.checkin_last.profile['lot_number']" v-bind:ref="'cat_no-'+stock_item.id"
                            class="block w-full mt-1   border-gray-400 rounded-md ">
                    </div>
                </div>
                <div class="flex ml-6">
                    <div class=" w-1/4 py-2 px-2 text-right"> ราคาต่อหน่วย:</div>
                    <div class=" w-3/4 ">
                     <input type="number"  v-model="stock_item.price" 
                            class="block w-full mt-1  border-gray-400 rounded-md ">
                    </div>
                </div>
                  <div class="flex ml-6 mt-2">
                    <div class=" w-1/4 py-2 px-2 text-right"> บริษัทผู้ขาย:</div>
                    <div class=" w-3/4 ">
                      <select 
                        class="block appearance-none w-full  bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight " >
                        <option v-for="(business) in  businesses" :key=business.id 
                            v-bind:value="{item_id:stock_item.id,business_id:business.id,business_name:business.business_name}"
                            >
                            {{business.business_name}}
                        </option>
                        </select>
                    </div>
                </div>
                <div class=" m-2">
                    
                          <button
                            class="w-full flex justify-center text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                            v-on:click="checkedOrder(index)"
                        >
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                           ใส่ตะกร้า
                        </button>
                </div>
                        
                
        </div>
    </div> -->
    <!-- end display card -->


    </AppLayout>
</template>
<script setup>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import OrderItem from '@/Components/OrderItem.vue'
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { onMounted, ref } from '@vue/runtime-core';

defineProps({
    stocks:Array,
    stock_items:Array,
    unit:Array,
    businesses:Array,
    sysdate_thai:String,
    sysdate:String,
})



const show_preorder=ref(false);

// const form = useForm({
//     items:[],
//     order_selected:[],
//     preview_orders: [{
//                         stock_id:0,
//                         id:0,
//                         sap:0,
//                         item_name:'',
//                         unit:0,
//                         price:0,
//                         business_id:0,
//                         business_name:'',
//                         total:0,
//                         catalog_number:'',
//                         lot_number:'',
//                     }],

//     business_selected:[],
   

// })

 
const itemsChecked=()=>{
    console.log('itemsChecked->'+from.preview_orders.length)
     from.preview_orders.length;
     show_preorder.value=true;
}

const  showPreorder=()=>{
            show_preorder.value=true;
}
const closePreviewOrder=()=>{
            show_preorder.value=false;
}


// export default {
//     components: {
//         AppLayout,
//         Link,
//     },
//     props:{
//         stocks:Array,
//         stock_items:Array,
//         unit:Array,
//         businesses:Array,
//         sysdate_thai:String,
//         sysdate:String,
      
//     },
//     data(){
//         return{
           
//            months:[
// 				{id:1,name:'มกราคม' },
// 				{id:2,name:'กุมภาพันธ์' },	
// 				{id:3,name:'มีนาคม' },	
//                 {id:4,name:'เมษายน' },	
//                 {id:5,name:'พฤษภาคม' },	
//                 {id:6,name:'มิถุนายน' },	
//                 {id:7,name:'กรกฎาคม' },	
//                 {id:8,name:'สิงหาคม' },	
//                 {id:9,name:'กันยายน' },	
//                 {id:10,name:'ตุลาคม' },	
//                 {id:11,name:'ฟฤศจิกายน' },	
//                 {id:12,name:'ธันวาคม' },		
// 			],
   
//             order_selected:[],

//             preview_orders: [{
//                             stock_id:0,
//                             id:0,
//                             sap:0,
//                             item_name:'',
//                             unit:0,
//                             price:0,
//                             business_id:0,
//                             business_name:'',
//                             total:0,
//                             catalog_number:'',
//                             lot_number:'',
//                             }],

//             business_selected:[],

//             show_preorder:0,
//             sum_pay:0,
//         }
//     },
//     methods: {
//         checkedOrder(index){
//            // console.log('checkedOrder');
//              this.preview_orders=[];
           
          
//             this.order_selected.forEach(item => {
//                  //console.log(item.id);
//                   // console.log(this.$refs['check-'+item.id].);
//                 if(this.$refs['item-'+item.id].value=='')
//                 {
//                         alert('กรุณาใส่จำนวนที่ต้องการสั่งซื้อ');
//                         this.$refs['itemcheck-'+item.id].value=false;
//                         return;
//                 }

//                 // console.log(this.business_selected);
//                 // console.log(this.business_selected[item.id]);
                
//                 // console.log(Object.keys(this.business_selected));
//                 // if(!JSON.stringify(this.business_selected).includes(item.id))
//                 // {
//                 //         alert('กรุณาระบุบริษัทผู้ขาย');
//                 //         return;
//                 // }

//                 let total_bath = this.$refs['item-'+item.id].value*this.$refs['price-'+item.id].value;
              
//                this.preview_orders.push({
//                                         stock_id:item.stock_id,
//                                         id:item.id,
//                                         sap:item.sap,
//                                         item_name:item.item_name,
//                                         unit:this.$refs['item-'+item.id].value,
//                                         price:this.$refs['price-'+item.id].value,
//                                         business_id:this.business_selected[item.id].business_id,
//                                         business_name:this.business_selected[item.id].business_name,
//                                         total:total_bath,
//                                         catalog_number:this.$refs['cat_no-'+item.id].value,
//                                         lot_number:this.$refs['lot_no-'+item.id].value,
//                                     });
//             })
           
//         },
//         createOrder(){
//                console.log('create order');
//            // console.log(this.preview_orders);
//             Inertia.post(route('add-order'), 
//                             { 
//                                 order_items:this.preview_orders,
//                             },
//                             {
//                                 preserveState: false,
//                             //   preserveScroll: true
//                             }
//                         );
               
//         },
//         showPreorder(){
//             this.show_preorder=1;
//         },
//         closePreviewOrder(){
//             this.show_preorder=0;
//         },
//         changePrice(index){
//              console.log('changePrice');
//             console.log(index);
//         },
//     },
//     computed:{
//        	itemsChecked(){
// 			return this.order_selected.length;	
// 		},
//         sumPay(){   
//             this.sum_pay = 0;
//             this.preview_orders.forEach(item => {            
//                 this.sum_pay += item.total;
//             });
             
//             return this.sum_pay.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// 		},
//     }

// }

</script>

