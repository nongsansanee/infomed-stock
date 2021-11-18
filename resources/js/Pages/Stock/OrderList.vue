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
<!-- {{$page.props.order_lists}} -->
     
        <!-- show order lists -->
         <h1 class="p-2 m-4 text-center" >ประวัติการสั่งซื้อพัสดุ</h1>
        <table class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<!-- <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ปี พ.ศ.</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">เดือน</th> -->
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่สร้างเอกสาร</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">เลขเอกสาร</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ผู้สร้างเอกสาร</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">สถานะ</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(order_list) in $page.props.order_lists" :key=order_list.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<!-- <td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg"><span class="inline-block w-1/3 md:hidden font-bold">ปี พ.ศ.</span>{{order_list.year+543}}</td> -->
                <td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg"><span class="inline-block w-1/3 md:hidden font-bold">วันที่สร้างเอกสาร</span> {{order_list.created_at_format}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">เลขเอกสาร</span>{{order_list.create_no}}/{{order_list.year}}</td> 
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">ผู้สร้างเอกสาร</span>{{order_list.user['name']}}</td>
                <td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3 md:hidden font-bold">สถานะ</span>
                    {{order_list.status}}
                   
					<!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                    </button> -->

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
                    <div>
                             <span class=" text-sm text-red-500">คำแนะนำ:เมื่อเซ็นเอกสารแล้ว กรุณากดปุ่มส่ง</span>
                    </div>
                   
				</td>
			</tr>
			
		</tbody>
	</table>

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
                {id:11,name:'ฟฤศจิกายน' },	
                {id:12,name:'ธันวาคม' },		
			],

            confirm_send_order:0,
            confirm_items:Array,
            confirm_order_id:0,
        }
    },
    methods:{
         confirmSendOrder(order){
             console.log('confirmSendOrder');
             console.log(order);
             console.log(order.id);
            // console.log(this.date_checkout[index]);
            // console.log(this.unit_checkout[index]);
            this.confirm_send_order = 1;
            this.confirm_items = order.items;
            this.confirm_order_id = order.id;
           
        },
        cancelSendOrder(){
            this.confirm_send_order = 0;
        },
        okConfirmSendOrder(){
            this.confirm_send_order = 0;
            console.log('OK Confirm SendOrder');
            console.log(this.confirm_order_id);
            // Inertia.post(route('send_order'), 
            //                  { 
            //                      order_id:this.confirm_order_id,
            //                   },
            //                   {
            //                       preserveState: false,
            //                     //   preserveScroll: true
            //                   }
            //                  );
        }
        
    },
    computed: {
            // dateOrderFormat() {
            // // `this` points to the vm instance
            //     return this.date_order_format;
            // }
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
