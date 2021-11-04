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
 <!-- {{stock_item_sum}} -->
 
    <div class="w-full mt-3 p-2  ">
  
        <div v-for="(stock_item,key) in stock_item_sum" :key=stock_item.id
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
                        (หน่วย: {{stock_item.unit_count.countname}})
                        <Link :href="route('list-stock-item',stock_item)">
                        <span
                            class="inline-flex text-md font-semibold leading-5 text-green-800 bg-green-200 rounded-lg"
                        >
                            ประวัติการรับเข้าและเบิกออก
                        </span>
                        </Link>
                    </div>
                
                
                    <div class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                        <div class=" ml-2"> จำนวนที่มี : </div>
                        <div class=" ml-2 text-red-600" >
                            {{stock_item.item_sum}}
                        <!-- <input type="number" name="" id="" 
                                v-model="stock_item_sum[key].item_sum"
                            class="w-full px-12 py- border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                            readonly
                            > -->
                        </div> 
                        <div class=" ml-2"> วันหมดอายุ : </div>
                        <div class=" ml-2 text-blue-600">{{stock_item.checkin_last.date_expire}}</div> 
                        <div class=" ml-2"> วันที่รับเข้า : </div>
                        <div class=" ml-2 text-blue-600">{{stock_item.checkin_last.date_action}}</div> 
                        <div class=" ml-2"> Cat.No/Lot.No : </div>
                        <div class=" ml-2 text-blue-600">{{stock_item.checkin_last.profile['catalog_number']}} /{{stock_item.checkin_last.profile['lot_number']}}</div> 
                    </div>
                
                
                    <div class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                        <div class=" m-2">
                            <label for="">วันที่เบิก:</label>
                            <input type="date" name="" id=""
                                v-model="date_checkout[key]"
                                class="w-full px-12 py-2 border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                        </div>
                        <div class=" m-2">
                            <label for="">จำนวน:</label>
                            <input type="number" name="" id="" 
                                v-model="unit_checkout[key]"
                                v-on:change="showItemBalance(key)" 
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
                            v-on:click="confirmCheckout(key,stock_item)"
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

        <!-- Modal -->
        <div v-if="confirm_checkout" 
                class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  
                id="modal-id">
            <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                    <!-- <h2 class="text-xl font-bold py-3 ">Are you sure?</h2> -->
                                    <p class="text-md font-bold text-red-600 py-3 px-8">คุณต้องการบันทึกการเบิกพัสดุรายการนี้ใช่หรือไม่?</p> 
                                    <p class="mt-2">{{confirm_item_name}} วันที่ {{ confirm_item_date}} จำนวน {{confirm_item_count}}</p>   
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button 
                            class="mb-2 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                            v-on:click="okConfirmCheckout"
                            >
                            ตกลง
                        </button>
                        <button 
                            class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600"
                            v-on:click="cancelConfirmCheckout"
                        >
                            ยกเลิก
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- add component ModalConfirm -->
            <!-- <modal-confirm v-if="confirm_checkout" 
                :confirm_item_name="confirm_item_name"
                :confirm_item_date="confirm_item_date"
                :confirm_item_count="confirm_item_count"
            ></modal-confirm> -->
        <!-- END -->
    
    </div>
   
  

    
     

    </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import ModalConfirm from '@/Components/ModalConfirm.vue'
export default {
    components: {
        AppLayout,
        Link,
        ModalConfirm,
    },
    props:{
        stocks:Array,
        stock_items:Array,
        unit:Array,
    },
    data(){
        return{
            unit_checkout:[],
            date_checkout:[],
            item_balance:0,
            confirm_checkout:0,
            confirm_item_name:'',
            confirm_item_slug:'',
            confirm_item_date:'',
            confirm_item_count:'',
            stock_item_sum:[...this.stock_items], //เอาตัวแปร จาก props มาใช้
        //    stocks:[
		// 		{code:1,name:'aa' },
		// 		{code:2,name:'bb' },	
		// 		{code:3,name:'cc' },		
		// 	],
        }
    },
    methods:{
        showItemBalance(index){
             console.log(index);
            // console.log(item_has);
            // console.log(this.unit_checkout[index]);
   
        //    this.stock_item_sum[index].item_sum  = this.stock_item_sum[index].item_sum - this.unit_checkout[index];
        //     console.log(this.stock_item_sum[index]);
      
        },
        confirmCheckout(index,stock_item){
             console.log('confirmCheckout');
            // console.log(stock_item);
            //  console.log(this.date_checkout);
            // console.log(this.date_checkout[index]);
            // console.log(this.unit_checkout[index]);
            this.confirm_checkout = 1;
            this.confirm_item_slug = stock_item.slug;
            this.confirm_item_name = stock_item.item_name;
            this.confirm_item_date = this.date_checkout[index];
            this.confirm_item_count = this.unit_checkout[index];
        },
        cancelConfirmCheckout(){
            this.confirm_checkout = 0;
        },
        okConfirmCheckout(){
            this.confirm_checkout = 0;
            console.log('OK Confirm');
            Inertia.post(route('checkout-stock-item'), 
                             { 
                                 item_slug:this.confirm_item_slug,
                                 date:this.confirm_item_date,
                                 unit:this.confirm_item_count,
                              }
                             );
        }
    },

    // setup() {
    
    //     return { };
    // },
}

</script>
