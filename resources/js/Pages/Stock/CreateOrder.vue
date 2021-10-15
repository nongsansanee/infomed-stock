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

    <h1 class=" m-3 text-center" >ข้อมูลจำนวนคงเหลือ ณ วันที่ปัจจุบัน {{$page.props.sysdate_thai}}</h1>

    <!-- test -->
    <table class="min-w-full border-collapse block  md:table">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ชื่อพัสดุ</th>
				<th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">Cat.No</th>
				<th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">Lot.No</th>
                <th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันหมดอายุ</th>
                <th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่รับเข้า</th>
                <th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">จำนวนคงเหลือ</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(stock_item) in $page.props.stock_items" :key=stock_item.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg">
                    <span class="inline-block w-1/3 md:hidden font-bold">ชื่อพัสดุ</span>
                     <input type="checkbox" name="" id="" class="w-4 h-4 border-2 border-green-800 shadow-sm text-green-600 rounded-md focus:ring-green-500">
                    {{stock_item.item_code}}{{stock_item.item_name}}
                </td>
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Cat.No</span>{{stock_item.catalog_number}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Lot.No</span>{{stock_item.lot_number}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันหมดอายุ</span>{{stock_item.date_expire}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่รับเข้า</span>{{stock_item.date_receive}}</td>
				<td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">จำนวนคงเหลือ</span>
                    <span
                        class="inline-flex px-2  text-lg font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                        >
                        {{stock_item.item_receive}}
                    </span>
                 
                     <input type="number" name="" id=""  placeholder="จำนวนที่จะสั่งซื้อ"
                                    class="block w-full mt-1 border-gray-400 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                  
				</td>
			</tr>
			
		</tbody>
	</table>
    <!-- END table -->
    <div>
         <button
                    class=" m-3 w-full flex justify-center px-8 py-1   text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    สร้างใบสั่งซื้อ
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
        sysdate_thai:String,
        sysdate:String,
      
    },
    data(){
        return{
           
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
        }
    },
    computed: {
            // a computed getter
            // convertYearThai() {
            // // `this` points to the vm instance
            //     return this.order_lists['year']+543;
            // }
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
