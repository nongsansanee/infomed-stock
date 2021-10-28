<template>
    <AppLayout>
        <div class=" w-full  bg-blue-100 p-2 rounded-md ">
            <div class="bg-blue-800 text-white text-xl text-center ">
                {{$page.props.unit.unitname}}
            </div>
            <div class="mt-3" >
                <label for="">เลือกคลังพัสดุ</label> 
            </div>
            <select name="" id="" 
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                <option v-for="(stock) in  $page.props.stocks" v-bind:key=stock.id v-bind:value="stock.id">{{stock.stockname}}</option>
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

        <h4  v-if="unit.unitid !=27" class=" mt-3 text-center text-red-600">ระบุปีและเดือน ที่ต้องการดูรายงานการเบิกใช้พัสดุ</h4>
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
            <button v-on:click="getReportStock()"
                class=" flex justify-center px-8 py-2 mb-2  text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
            >
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg> -->
                ดูข้อมูลการเบิก
            </button>
        </div>

        <!-- TABLE -->
    <!-- {{$page.props.stock_items}} -->
    <table v-if="demo_show_stock_items != 0" class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-pink-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">SAP:ชื่อพัสดุ</th>
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
			<tr v-for="(stock_item) in $page.props.stock_items" :key=stock_item.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg">
                    <span class="inline-block w-1/3 md:hidden font-bold">SAP:ชื่อพัสดุ</span>
                    {{stock_item.item_code}}:{{stock_item.item_name}}
                </td>
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Cat.No</span>AHGH103</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Lot.No</span>234AB</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันหมดอายุ</span>2022-01-31</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่รับเข้า</span>2021-10-01</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่เบิก</span>2021-10-19</td>
                <td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">เบิก</span>
                    <span
                        class="inline-flex px-2  text-lg font-semibold leading-5 text-red-800 bg-red-100 rounded-full"
                        >
                        5
                    </span>
                 
				</td>
                 <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">ผู้เบิก</span>นายทดสอบ การเบิก</td>
            </tr>
			
		</tbody>
	</table>
    <!-- END table -->

      <div v-if="demo_show_stock_items !=0"  class=" mt-6 flex flex-col  ">
                <!-- <button
                    class="px-3 py-1  text-sm text-gray-700 bg-gray-400 rounded-md hover:bg-gray-300 focus:outline-none"
                >
                    Cancel
                </button> -->
                <!-- <button v-if="unit.unitid !=27"
                    class=" flex justify-center px-8 py-1   text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                >
                    สร้างรายงาน
                </button> -->

                <button
                    class=" flex justify-center mt-3 px-8 py-1   text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    พิมพ์รายงาน
                </button>
                <button
                    class=" flex justify-center mt-3 px-8 py-1   text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    export excel file
                </button>
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
            demo_show_stock_items:0,
            unit_selected:'',
            year_selected:'',
            month_selected:'',
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
    methods:{
        getReportStock(){
            console.log('hi');
            console.log(this.unit_selected);
            console.log(this.year_selected);
            console.log(this.month_selected);
            this.demo_show_stock_items=1;
        }
    },

    // setup() {
    
    //     return { };
    // },
}

</script>
