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
    <div class=" flex justify-between my-2 ">
            <div class=" font-bold" >ประวัติการสั่งซื้อพัสดุ</div>
            <div >
                <select name="" id=""
                    class=" w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow  focus:outline-none focus:shadow-outline"
                >
                    <option value="">รายการทั้งหมด</option>
                    <option value="">รายการที่ยังไม่ส่งไปภาคฯ</option>
                    <option value="">รายการที่รอภาคฯอนุมัติ</option>
                    <option value="">รายการที่ภาคฯอนุมัติแล้ว</option>
                    <option value="">รายการที่ตรวจรับพัสดุแล้ว</option>
                </select>
            </div>
    </div>

    <div v-for="(order_list,key) in $page.props.order_lists" :key=order_list.id class="mt-5">
        <div class="w-full mt-4 lg:max-w-full lg:flex">
            <!-- <div
            class="flex-none h-48 overflow-hidden text-center bg-cover rounded-t lg:h-auto lg:w-48 lg:rounded-t-none lg:rounded-l"
            style="background-image: url('https://picsum.photos/id/0/192/213')"
            title="Woman holding a mug"
            ></div> -->
            
            <div
                class="w-full flex flex-col justify-between p-4 leading-normal bg-white border border-gray-200 rounded-md shadow-lg   "
                >
                <div class=" flex justify-between border-b-2  py-1 mb-2">
                   
              
                    <p  class="flex items-center font-bold  ">
                        {{key+1}}. เลขเอกสาร:{{order_list.create_no}}/{{order_list.year}}
                          <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                        </svg> -->
                         
                    </p>
                    <p v-if="order_list.status != 'created'" class=" font-bold  ">
                         เลขที่ใบสั่งซื้อ:{{order_list.order_no}}/{{order_list.year}}
                    </p>
                    <Link >
                            <span
                                class="inline-flex text-sm font-semibold leading-5 text-blue-800 bg-blue-200 rounded-md"
                            >
                               <span v-if="order_list.status=='created'" >ยังไม่ส่งไปภาคฯ</span>
                                <span v-if="order_list.status=='send'" >รอภาคฯอนุมัติ</span>
                                <span v-if="order_list.status=='approve'" >ภาคฯอนุมัติแล้ว</span>
                                <span v-if="order_list.status=='checkin'"  class="inline-flex text-sm font-semibold leading-5 text-green-800 bg-green-200 rounded-md">ตรวจรับพัสดุแล้ว</span>
                            </span>
                    </Link>
                </div>
                <div class=" flex flex-row ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                     <span class="inline-block w-1/3  font-bold">วันที่สร้างเอกสาร</span> {{order_list.created_at_format}} 
                </div>
                <div v-if="order_list.status != 'created'  " >
                    <!-- arrow1 -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                    </svg>
                </div>
                <div v-if="order_list.status != 'created'  " class=" flex flex-row ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                   
                    <span class="inline-block w-1/3  font-bold">วันที่ส่งใบสั่งซื้อ</span>
                    <span v-if="order_list.order_no" class=" px-1" >
                        <span class=" ">{{order_list.timeline['send_datetime']}}</span>
                    </span>
                </div>
                 <div v-if="order_list.status == 'approve' || order_list.status == 'checkin'">
                    <!-- arrow2 -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                    </svg>
                </div>
                 <div v-if="order_list.status == 'approve' || order_list.status == 'checkin'" class=" flex flex-row ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                     <span class="inline-block w-1/3  font-bold">วันที่อนุมัติ</span> {{order_list.timeline['approve_datetime']}}
                </div>
                 <div v-if=" order_list.status == 'checkin'">
                    <!-- arrow3 -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                    </svg>
                </div>
                 <div v-if=" order_list.status == 'checkin'" class=" flex flex-row ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                     <span class="inline-block w-1/3  font-bold">วันที่ตรวจรับพัสดุ</span> {{order_list.timeline['checkin_datetime']}}
                </div>
                
                <div>
                    <!-- <span class="inline-block w-1/3  font-bold">สถานะ</span>
                    <span v-if="order_list.status=='created'" >ยังไม่ส่งไปภาคฯ</span>
                    <span v-if="order_list.status=='send'" >รอภาคฯอนุมัติ</span>
                    <span v-if="order_list.status=='approve'" >ภาคฯอนุมัติแล้ว</span> -->
                        
                    <div>
                            <span v-if="order_list.status == 'created'" class=" text-sm text-red-500">คำแนะนำ:กดปุ่มพิมพ์และเซ็นเอกสาร แล้วส่งเอกสารตัวจริงไปที่ภาควิชาฯ แล้วกดปุ่มส่ง</span>
                            <span v-if="order_list.status == 'send'" class=" text-sm text-red-500">คำแนะนำ:รออนุมัติการสั่งซื้อ จากภาควิชาฯ</span>
                            <span v-if="order_list.status == 'approve'" class=" text-sm text-red-500">
                                คำแนะนำ:รีบดำเนินการให้บริษัทเซ็นใบสั่งซื้อ+ส่งของ+ตรวจรับ ภายใน 7 วันทำการ นับจากวันที่ได้รับอนุมัติ เมื่อตรวจรับพัสดุตามเอกสารสั่งซื้อแล้ว ให้กดปุ่มตรวจรับพัสดุ แล้วกดปุ่มพิมพ์เอกสารตรวจรับพัสดุและเซ็นเอกสาร แล้วส่งเอกสารตัวจริงไปที่ภาควิชาฯ   
                            </span>
                            <!-- <span v-if="order_list.status == 'checkin'" class=" text-sm text-red-500">
                                คำแนะนำ:กดปุ่มพิมพ์เอกสารรับพัสดุและเซ็นเอกสาร แล้วส่งเอกสารตัวจริงไปที่ภาควิชาฯ
                            </span> -->
                    </div>
                    <div class="flex flex-col ">
                        <div class="flex flex-row">
                            <span class="  font-bold">รายละเอียด</span>
                             <button
                                class=" flex justify-center px-2  text-white rounded-md hover:bg-blue-200 focus:outline-none"
                                v-on:click="viewDetailItem(key,order_list.items)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            </button>
                        </div>
                    </div>
                    <div v-if="key==view_order">
                        <div v-for="(item) in view_items" :key=item.id>
                                <span   class=" px-1" >
                                     {{item.sap}}:{{item.item_name}} จำนวน {{item.unit}} ชิ้น ราคาชิ้นละ {{item.price}} บาท -->stock_item_id({{item.id}})
                                </span>
                        </div>
                    </div>
                    <div class=" flex justify-center">
                    <a :href="route('print-order',order_list.id)" v-if="order_list.status == 'created'" target="blank">
                        <span
                            class="inline-flex text-sm py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                เอกสารใบสั่งซื้อ
                        </span>
                    </a>
                     <a :href="route('print-checkin',order_list.id)" v-if="order_list.status == 'checkin'" target="self">
                        <span
                            class="flex flex-row text-sm py-1 px-2 leading-5 text-white bg-yellow-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                              เอกสารตรวจรับพัสดุ
                        </span>
                    </a>
					
                   
                    <button v-if="order_list.status == 'created'"
                        v-on:click="confirmSendOrder(order_list)"
                        class=" inline-flex text-sm ml-3 bg-green-500 hover:bg-green-700 text-white  py-1 px-2 border border-green-500 rounded">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                         ส่งเอกสารสั่งซื้อ
                    </button>
                    <!-- <button v-if="order_list.status == 'approve'"
                        v-on:click="confirmCheckinOrder(order_list)"
                        class="flex flex-row text-sm py-1 px-2 ml-3 bg-green-500 hover:bg-green-700 text-white  text-center border border-green-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                        xตรวจรับพัสดุ
                    </button> -->
                    <a :href="route('receive-order',order_list)" v-if="order_list.status == 'approve'" >
                        <span
                            class="flex flex-row text-sm py-1 px-2  leading-5 text-white bg-green-500 hover:bg-green-700 rounded"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                        ตรวจรับพัสดุ
                        </span>
                    </a>
                    <button v-if="order_list.status == 'created'"
                        class="flex ml-3 bg-red-500 hover:bg-red-700 text-white d py-1 px-8 text-sm border border-red-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        ลบ
                    </button>
                 
                    </div>
                    
                </div>
              
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
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
        unit:Object,
        order_lists:Object,
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
            view_items:Array,
            view_order:0,
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
            
            // console.log(order.id);
            // console.log(order);
                 Inertia.post(route('checkin-order'), 
                             { 
                                 order_id:order.id,
                              },
                              {
                                  preserveState: false,
                              
                              }
                 )
        },
        viewDetailItem(index,items){
            // console.log(index);
            // console.log(items);
            this.view_items=items;
            this.view_order=index;
        }
        
    },
    computed: {
           
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
