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

       <h4   class=" mt-3 text-center text-red-600">ระบุปีและเดือน ที่ต้องการดูรายงาน</h4>
        <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
            <div class=" m-2">
                <label for="">ปี พ.ศ.</label>
                <select name="" id="" v-model="year_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                    <option v-for="(year,index) in  years" :key=index v-bind:value="year">{{year+543}}</option>
                </select>
            </div>
            <div  class=" m-2">
                <label for="">เดือน</label>
                <select name="" id="" v-model="month_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                    <option v-for="(month) in  months" :key=month.id v-bind:value="month.id">{{month.name}}</option>
                </select>
                
            </div>  
            
        </div>
          <div class="flex flex-col  ">
            <!-- <button
                class="px-3 py-1  text-sm text-gray-700 bg-gray-400 rounded-md hover:bg-gray-300 focus:outline-none"
            >
                Cancel
            </button> -->
            <button 
                class=" flex justify-center px-8 py-2 mb-2  text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
            >
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg> -->
                ค้นหา
            </button>
        </div>
        <!-- {{$page.props.order_lists}} -->
     
        <!-- show order lists -->
         <h1 class="p-2 mt-3 text-center" >รายการใบสั่งซื้อพัสดุจากสาขา/หน่วย</h1>
         <h1 class=" text-center" >(ณ เดือนปีปัจจุบัน)</h1>
        <table class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่ ที่สาขา/หน่วยส่งใบสั่งซื้อ</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left  md:table-cell md:rounded-lg">ชื่อคลังพัสดุ</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">เลขที่ใบสั่งซื้อ</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">สถานะ</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(order_list) in $page.props.order_lists" :key=order_list.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left block md:w-1/5 md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg"><span class="inline-block w-1/3 md:hidden font-bold">วันที่ ที่สาขา/หน่วยส่งใบสั่งซื้อ</span>{{order_list.send_date_format}}</td>
                <td class="text-left block md:w-2/5 md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">ชื่อคลังพัสดุ</span>{{order_list.stock['stockname']}}</td>
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">เลขที่ใบสั่งซื้อ</span>
                       <span v-if="order_list.order_no!=0">
                        {{order_list.order_no}}/{{order_list.year}}
                       </span>
                </td>
                <td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3 md:hidden font-bold">สถานะ</span>
                    {{order_list.status}}
                   
                    <a  v-if="order_list.status !='created'" 
                        :href="route('print-order',order_list.id)" target="blank">
                        <span
                            class="inline-flex text-md py-1 px-2 font-semibold leading-5 text-white bg-blue-500 rounded-md"
                        >
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                            </svg>
                        </span>
                    </a>

                    <button v-if="order_list.status == 'send'"
                        v-on:click="confirmApproveOrder(order_list)"
                        class=" ml-3 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                    </button>
					<div>
                            <span v-if="order_list.status == 'send'" class=" text-sm text-red-500">คำแนะนำ:เมื่อหัวหน้าภาควิชาฯ เซ็นอนุมัติแล้ว ให้กดปุ่มอนุมัติ</span>
                    </div>
                  
				</td>
			</tr>
			
		</tbody>
	</table>

          <!-- Modal -->
        <div v-if="confirm_approve_order" 
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
                                    <p class="text-md font-bold text-red-600 py-2 px-8">คุณต้องการอนุมัติเอกสารการสั่งซื้อพัสดุนี้ใช่หรือไม่?</p> 
                                    <!-- <p class="mt-2">{{confirm_items}}</p>    -->
                                       <label 
                                         class="  flex  justify-start w-full text-sm text-red-900">
                                        ใบสั่งซื้อเลขที่:{{confirm_order_id}}/{{confirm_order_year}} ของ {{confirm_stockname_order}}
                                    
                                    </label>
                    </div>
                    <!--footer-->
                    <div class="p-3  mt-2 text-center space-x-4 md:block">
                        <button 
                            class="mb-2 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-green-400"
                            v-on:click="okConfirmApproveOrder"
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
        // stocks:Array,
        // unit:Array,
        order_lists:Array,
    },
    data(){
        return{
            years:[2022,2021,2020,2019,2018],
            months:[
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
                {id:11,name:'ฟฤศจิกายน' },	
                {id:12,name:'ธันวาคม' },		
			],
            confirm_approve_order:0,
            confirm_stockname_order:'',
            confirm_order_id:0,
            confirm_order_year:0,
        }
    },
    methods:{
        confirmApproveOrder(order){
             console.log('confirmApproveOrder');
             console.log(order);
             console.log(order.id);
             console.log(order.stock['stockname']);
          
            this.confirm_approve_order = 1;
            this.confirm_order_id = order.id;
            this.confirm_order_year = order.year;
            this.confirm_stockname_order = order.stock['stockname'];
          
        },
        cancelSendOrder(){
            this.confirm_approve_order = 0;
        },
        okConfirmApproveOrder(){
            this.confirm_approve_order = 0;
            console.log('OK ApproveOrder');
            console.log(this.confirm_order_id);
            Inertia.post(route('approve-order'), 
                             { 
                                 order_id:this.confirm_order_id,
                              },
                              {
                                  preserveState: false,
                                //   preserveScroll: true
                              }
                             );
        }
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
