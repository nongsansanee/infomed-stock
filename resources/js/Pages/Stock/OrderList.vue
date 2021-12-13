<template>
    <AppLayout>
          <!--Header Alert-->
            <div v-if="$page.props.flash.status=='success'" 
                class="alert-banner  fixed  right-0 m-2 w-2/3 md:w-full max-w-sm ">
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
       
<!-- {{$page.props.order_lists}} -->
     
        <!-- show order lists -->
    <h1 class="p-2 m-4 text-center" >ประวัติการสั่งซื้อพัสดุ</h1>

    <div v-for="(order_list) in $page.props.order_lists" :key=order_list.id class="mt-5">
        <div class="w-full max-w-sm mt-6 lg:max-w-full lg:flex">
            <!-- <div
            class="flex-none h-48 overflow-hidden text-center bg-cover rounded-t lg:h-auto lg:w-48 lg:rounded-t-none lg:rounded-l"
            style="background-image: url('https://picsum.photos/id/0/192/213')"
            title="Woman holding a mug"
            ></div> -->
            
            <div
                class="w-full flex flex-col justify-between p-4 leading-normal bg-white border border-gray-200 rounded-md shadow-lg   "
                >
                <p v-if="order_list.status == 'approve'" class="flex items-center text-sm text-green-600">
                    <svg
                        class="w-4 h-4 mr-2 text-gray-500 fill-current"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                        d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"
                        />
                    </svg>
                    เสร็จแล้ว
                </p>
                 <p v-else class="flex items-center text-sm text-red-600">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                    </svg>
                    กำลังดำเนินการ
                </p>
                <div>
                     <span class="inline-block w-1/3  font-bold">วันที่สร้างเอกสาร</span> {{order_list.created_at_format}} 
                </div>
                 <div class=" flex">   
                     <span class="inline-block w-1/3  font-bold">เลขเอกสาร</span> <span class=" px-1" >{{order_list.create_no}}/{{order_list.year}}</span> 
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 " viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <span class="inline-block w-1/3  font-bold">เลขใบสั่งซื้อ</span><span v-if="order_list.order_no" class=" px-1" >{{order_list.order_no}}/{{order_list.year}}</span>
                </div>
                <div>
                    <span class="inline-block w-1/3  font-bold">สถานะ</span>{{order_list.status}} 
                       <a :href="route('print-order',order_list.id)" target="blank">
                        <span
                            class="inline-flex text-md py-1 px-2 font-semibold leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </a>
					
                    <button v-if="order_list.status == 'created'"
                        class=" ml-3 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <button v-if="order_list.status == 'created'"
                        v-on:click="confirmSendOrder(order_list)"
                        class=" ml-3 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                      <button v-if="order_list.status == 'approve'"
                        v-on:click="confirmCheckinOrder(order_list)"
                        class=" ml-3 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                    </button>
                    <div>
                            <span v-if="order_list.status == 'created'" class=" text-sm text-red-500">คำแนะนำ:กดปุ่มพิมพ์ และเซ็นเอกสาร แล้วส่งเอกสารตัวจริงไปที่ภาควิชาฯ แล้วกดปุ่มส่ง</span>
                            <span v-if="order_list.status == 'send'" class=" text-sm text-red-500">คำแนะนำ:รออนุมัติการสั่งซื้อ จากภาควิชาฯ</span>
                            <span v-if="order_list.status == 'approve'" class=" text-sm text-red-500">
                                คำแนะนำ:รีบดำเนินการให้บริษัทเซ็นใบสั่งซื้อ+ส่งของ+ตรวจรับ ภายใน 7 วันทำการ เมื่อตรวจรับของแล้ว กรุณากดปุ่มตรวจรับ   
                                (วันที่อนุมัติ:{{order_list.timeline['approve_datetime']}})
                            </span>
                    </div>
                </div>
              
                <div class="flex items-center">
                                <img
                                class="w-10 h-10 mr-4 rounded-full"
                                src="https://via.placeholder.com/50"
                                alt="Avatar of Jonathan Reinink"
                                />
                                <div class="text-sm">
                                <p class="leading-none text-gray-900">{{order_list.user['name']}}</p>
                                <p class="text-gray-600">ผู้สร้างเอกสาร</p>
                                </div>
                </div>
            </div>
        </div>
    </div>
    

        <!-- Modal -->
        <div v-if="confirm_send_order" 
                class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  
                id="modal-id">
            <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
                <div class="">
                    <!--body-->
                    <div class="text-center p-3 flex-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          
                                    <!-- <h2 class="text-xl font-bold py-3 ">Are you sure?</h2> -->
                                    <p class="text-md font-bold text-red-600 py-2 px-8">คุณต้องการส่งเอกสารการสั่งซื้อพัสดุนี้ใช่หรือไม่?</p> 
                                    <!-- <p class="mt-2">{{confirm_items}}</p>    -->
                                       <label v-for="(confirm_item,index) in confirm_items" :key=confirm_item.id
                                         class="  flex  justify-start w-full bg-red-100 text-sm text-red-900">
                                        {{index+1}}.{{confirm_item.item_name}} จำนวน {{confirm_item.unit}} x {{confirm_item.price}}  เป็นเงิน {{confirm_item.total}} บาท
                                    
                                    </label>
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button 
                            class="mb-2 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                            v-on:click="okConfirmSendOrder"
                            >
                            ตกลง
                        </button>
                        <button 
                            class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600"
                            v-on:click="cancelSendOrder"
                        >
                            ยกเลิก
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        

    </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        AppLayout,
        Link,
    },
    props:{
        stocks:Array,
        unit:Array,
        order_lists:Array,
    },
    data(){
        return{
           
           months:[
               	{id:0,name:'-' },
				{id:1,name:'มกราคม' },
				{id:2,name:'กุมภาพันธ์' },	
				{id:3,name:'มีนาคม' },	
                {id:4,name:'เมษายน' },	
                {id:5,name:'พฤษภาคม' },	
                {id:6,name:'มิถุนายน' },	
                {id:7,name:'กรกฎาคม' },	
                {id:8,name:'สิงหาคม' },	
                {id:9,name:'กันยายน' },	
                {id:10,name:'ตุลาคม' },	
                {id:11,name:'พฤศจิกายน' },	
                {id:12,name:'ธันวาคม' },		
			],

            confirm_send_order:0,
            confirm_items:Array,
            confirm_order_id:0,
        }
    },
    methods:{
         confirmSendOrder(order){
      
            this.confirm_send_order = 1;
            this.confirm_items = order.items;
            this.confirm_order_id = order.id;
           
        },
        cancelSendOrder(){
            this.confirm_send_order = 0;
        },
        okConfirmSendOrder(){
            this.confirm_send_order = 0;
           
            Inertia.post(route('send-order'), 
                             { 
                                 order_id:this.confirm_order_id,
                              },
                              {
                                  preserveState: false,
                              
                              }
                             );
        },
        confirmCheckinOrder(order){
            
            console.log(order.id);
            console.log(order);
                 Inertia.post(route('checkin-order'), 
                             { 
                                 order_id:order.id,
                              },
                              {
                                  preserveState: false,
                              
                              }
                 )
        }
        
    },
    computed: {
           
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
