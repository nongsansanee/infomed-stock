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
      

    <h1 class=" m-3 text-center" >ข้อมูลจำนวนคงเหลือ ณ วันที่ปัจจุบัน {{$page.props.sysdate_thai}}</h1>

    <!-- item order -->
   
  
    <div class=" flex text-right ">
     
        <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div >
        <div  class="">
                 <span
                        class="inline-flex px-2  text-lg font-semibold leading-5 text-white bg-red-500 rounded-full"
                        >{{preview_order_count}}</span>
        </div>
        
    </div>
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
                <th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ราคาต่อหน่วย</th>
                <th class="bg-green-700 p-2 text-white font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">บริษัทผู้ขาย</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(stock_item,key) in $page.props.stock_items" :key=stock_item.id
                class="bg-white p-2 mb-2 border-2 border-gray-500 md:border-none block md:table-row">
				<td class="text-left  block md:table-cell md:border-b md:border-gray-400 md:rounded-l-lg">
                    <span class="inline-block w-1/3 md:hidden font-bold">ชื่อพัสดุ</span>
                     <input type="checkbox"  v-model="order_selected" 
                        v-bind:value="{id:stock_item.id , sap:stock_item.item_code, item_name:stock_item.item_name}"
                        v-on:change="checkedOrder"
                       class="w-4 h-4 border-2 border-red-700 shadow-sm text-red-600 rounded-sm focus:ring-red-500"
                    >
                    {{stock_item.item_code}}:{{stock_item.item_name}}
                </td>
				<td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Cat.No</span>{{stock_item.checkin_last.profile['catalog_number']}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">Lot.No</span>{{stock_item.checkin_last.profile['lot_number']}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันหมดอายุ</span>{{stock_item.checkin_last.date_expire}}</td>
                <td class="text-left  block md:table-cell md:border md:border-gray-400"><span class="inline-block w-1/3 md:hidden font-bold">วันที่รับเข้า</span>{{stock_item.checkin_last.date_action}}</td>
				<td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">จำนวนคงเหลือ</span>
                    <span
                        class="inline-flex px-2  text-lg font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                        >
                        {{stock_item.item_sum}}
                    </span>
                 
                     <input type="number"   placeholder="จำนวนสั่งซื้อ"  v-bind:ref="'item-'+stock_item.id" 
                            class="block w-full mt-1 border-gray-400 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                  
				</td>
                <td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">ราคาต่อหน่วย</span>
                     <input type="number"  v-model="stock_item.price" v-bind:ref="'price-'+stock_item.id"
                            class="block w-full mt-1 border-gray-400 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500">
                  
				</td>
                 <td class="text-left  block md:text-center md:table-cell md:border-b md:border-gray-400 md:rounded-r-lg">
					<span class="inline-block w-1/3  md:hidden font-bold">บริษัทผู้ขาย</span>
                      <select v-model="business_selected[stock_item.id]"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                        <option v-for="(business) in  $page.props.businesses" :key=business.id 
                            v-bind:value="{item_id:stock_item.id,business_id:business.id,business_name:business.business_name}"
                            v-bind:ref="'business-'+stock_item.id"
                            >
                            {{business.business_name}}
                        </option>
                    </select>
                  
				</td>
			</tr>
			
		</tbody>
	</table>
    <!-- END table -->
    <div>
         <button
            class=" m-3 w-full flex justify-center px-8 py-1   text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
            v-on:click="createOrder()"
            >
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> -->
                    สร้างใบสั่งซื้อ
        </button>
    </div>
     <!-- <span>order selected: {{ order_selected }} </span> -->
     <div>
         <h2 class=" m-3 text-center">Preview Order</h2>
     </div>
     <div>
         {{preview_orders}}
     </div>
    
      <!-- <span>order unit: {{ order_item_units }}</span> -->

      
      

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
        businesses:Array,
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
            // stock_item_order:[ 
            //                  {item_order:0,price_order:0},
            //                 ],

           // order_selected: [{id:0,sap:0,item_name:'',unit:0}],
            order_selected:[],

            preview_orders: [{id:0,sap:0,item_name:'',unit:0,price:0,business_id:0,business_name:''}],

            preview_order_count:0,
            business_selected:[],
           
        }
    },
    methods: {
        checkedOrder(){
            // console.log('checkedOrder');
         

             this.preview_orders=[];
            // console.log(this.$refs['item-'+item.id].value);
          
            this.order_selected.forEach(item => {
                 console.log(item.id);
                if(this.$refs['item-'+item.id].value=='')
                {
                        alert('กรุณาใส่จำนวนที่ต้องการสั่งซื้อ');
                        return;
                }

                console.log(this.business_selected);
                console.log(this.business_selected[item.id]);
                
                console.log(Object.keys(this.business_selected));
                // if(!JSON.stringify(this.business_selected).includes(item.id))
                // {
                //         alert('กรุณาระบุบริษัทผู้ขาย');
                //         return;
                // }
              
               this.preview_orders.push({
                                        id:item.id,
                                        sap:item.sap,
                                        item_name:item.item_name,
                                        unit:this.$refs['item-'+item.id].value,
                                        price:this.$refs['price-'+item.id].value,
                                        business_id:this.business_selected[item.id].business_id,
                                        business_name:this.business_selected[item.id].business_name,
                                    });
            })

            this.preview_order_count = this.preview_orders.length;
           
        },
        createOrder(){
               console.log('create order');
           
              this.order_selected.forEach(item => {
                console.log(item.id)
                console.log(this.$refs['item-'+item.id].value);
                  // this.preview_orders.push({unit:this.$refs['item-'+item.id].value});
                
            
                   
              })
                    //console.log(this.$refs['item-'+this.order_selected.id].value);
               
        }
    },
    computed:{
       
    }

    // setup() {
    
    //     return { };
    // },
}

</script>
