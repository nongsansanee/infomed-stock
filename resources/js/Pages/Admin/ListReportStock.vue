<template>
    <AppLayout>
       <h4   class=" mt-3 text-center text-red-600">ระบุชื่อคลังพัสดุ ปีและเดือน ที่ต้องการดูรายงาน</h4>
    
        <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
             <div class="m-2" >
                <label for="">ชื่อคลังพัสดุ</label> 
            
                <select name="" id="" v-model="stock_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                    <option v-for="(stock) in  $page.props.stocks" :key=stock.id v-bind:value="stock.slug">{{stock.stockname}}</option>
                </select>
            </div>
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
             <!-- <Link :href="route('admin-report-stock',{stock_slug:stock_selected,year:year_selected,month:month_selected})"> -->
                <button 
                    class=" w-full flex justify-center px-8 py-2 mb-2  text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                    @click="getStockReport(stock_selected,year_selected,month_selected)"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    ค้นหา
                </button>
            <!-- </Link> -->
        </div>
        <!-- {{$page.props.report_lists}} -->
        <p v-if="item_trans.length==0"
        class="w-full  text-center bg-pink-200"
        >
            ไม่พบข้อมูล
        </p>
        <!-- show order lists -->
         <h1 class="p-2 mt-3 text-center" >รายงานการเบิกพัสดุ</h1>

<!-- {{item_trans.length}} -->
 
     <table v-if="demo_show_stock_items != 0" class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">SAP-ชื่อพัสดุ-คงเหลือ</th>
				<th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">Cat.No</th>
				<th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">Lot.No</th>
                <th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันหมดอายุ</th>
                <th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่รับเข้า</th>
                <th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่เบิก</th>
                <th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">จำนวน</th>
                <th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ผู้เบิก</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(item_tran) in item_trans" :key=item_tran.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left text-sm  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg">
                    <span class="inline-block  w-1/3 md:hidden font-bold">ชื่อพัสดุ</span>
                        {{item_tran.item_code}}-{{item_tran.item_name}}
                    <span class="inline-flex px-2  text-lg font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                         {{item_tran.stock_item.item_sum}}
                    </span>
                   
                </td>
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Cat.No</span>wait</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Lot.No</span>wait</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันหมดอายุ</span>wait</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่รับเข้า</span>wait</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่เบิก</span>{{item_tran.date_action}}</td>
                <td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">จำนวน</span>
                    <span
                        class="inline-flex px-2  text-lg font-semibold leading-5 text-red-800 bg-red-100 rounded-full"
                        >
                        {{item_tran.item_count}}
                    </span>
                 
				</td>
                 <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">ผู้เบิก</span> {{item_tran.user.name}}</td>
            </tr>
			
		</tbody>
	</table>
    <!-- END table -->
        
    <!-- <table class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันเดือนปีที่ส่ง</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">สาขา</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">สถานะ</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(report_list) in $page.props.report_lists" :key=report_list.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg"><span class="inline-block w-1/3 md:hidden font-bold">วันเดือนปีที่ส่ง</span>{{report_list.updated_at}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">สาขา</span>{{report_list.unit_name}}</td>
				<td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3 md:hidden font-bold">สถานะ</span>
                    {{report_list.status}}
                   
					<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                    </button>
					
                    <button v-if="report_list.status == 'รอตรวจสอบ'"
                        class=" ml-3 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </button>
                  
				</td>
			</tr>
			
		</tbody>
	</table> -->

      
        

    </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        AppLayout,
        Link,

    },
    props:{
        stocks:Array,
        // unit:Array,
        report_lists:Array,
        // item_tran:Array,
    },
    data(){
        return{
            stock_selected:'',
            year_selected:'',
            month_selected:'',
            item_trans:[],
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
                {id:11,name:'พฤศจิกายน' },	
                {id:12,name:'ธันวาคม' },		
			],
        }
    },
    computed: {
            // a computed getter
            // convertYearThai() {
            // // `this` points to the vm instance
            //     return this.order_lists['year']+543;
            // }
    },
    methods:{
        // test_stock_selected(){
        //     console.log('aaaaaaaaaa');
        //     console.log(this.stock_selected);
        // }
        getStockReport(stock_selected,year_selected,month_selected){
                // console.log('aaaaaaaaaa');
                // console.log(stock_selected);
                // console.log(year_selected);
                // console.log(month_selected);
                // Inertia.get(route('admin-report-stock',{stock_slug:stock_selected,year:year_selected,month:month_selected}), 
                //              { replace: true });
                axios.get(route('admin-report-stock',{stock_slug:stock_selected,year:year_selected,month:month_selected})).then(res => {
                   console.log(res.data.item_tran);
                   this.item_trans = res.data.item_tran;
                });
        }
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
