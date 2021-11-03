<template>
     <AppLayout>
  
    <div class="bg-blue-800 text-white text-xl text-center ">
            {{$page.props.stock.stockname}}
    </div>

    <!-- Item Detail -->
     <div class="w-full mt-3 p-2  ">
  
      <div 
            class="w-full bg-purple-100  mt-3 border-2 border-purple-300 rounded-lg lg:max-w-full lg:flex">
        <div
          class="flex-none h-32 overflow-hidden text-center  bg-cover rounded-t lg:h-auto lg:w-36 lg:rounded-t-none lg:rounded-l"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-2o" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        
        <div class="w-full  leading-normal  border-b border-l border-r border-gray-200 rounded-b lg:border-l-0 lg:border-t lg:border-gray-200 lg:rounded-b-none lg:rounded-r"
        >
            <div class=" mb-2">
                <div class="p-2 text-md font-bold text-gray-900">
                    SAP:{{$page.props.stock_item.item_code}}
                    <label for="" class="text-blue-600">{{$page.props.stock_item.item_name}}</label>
                    (หน่วย: {{$page.props.stock_item.unit_count_id}})
                   
                </div>
               
            
                <div class="flex flex-col lg:flex-row mb-2 text-md font-bold text-gray-900">
                    <div class=" ml-2"> จำนวนคงเหลือ : </div>
                    <div class=" ml-2 text-red-600">{{$page.props.stock_item.item_sum}}</div> 
                    <div class=" ml-2"> วันหมดอายุ : </div>
                    <div class=" ml-2 text-blue-600">-</div> 
                    <div class=" ml-2"> วันที่รับเข้า : </div>
                    <div class=" ml-2 text-blue-600">-</div> 
                     <div class=" ml-2"> Cat.No/Lot.No : </div>
                    <div class=" ml-2 text-blue-600">aaa/bbb</div> 
                </div>
            </div> 
        </div>
      </div>
    </div>
    <!-- END Item Detail -->
 <!-- {{$page.props.item_check_outs}}  -->
    <!-- start Table -->
    <table  class="min-w-full border-collapse block  md:table md:rounded-md">
		<thead class="block  md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                <th class=" bg-blue-300 p-2 text-black font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">วันที่เบิก</th>
                <th class="bg-blue-300 p-2 text-black font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">จำนวน</th>
                <th class="bg-blue-300 p-2 text-black font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">ผู้เบิก</th>
                 <th class="bg-blue-300 p-2 text-black font-bold md:border md:border-grey-300 text-left block md:table-cell md:rounded-lg">::</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
			<tr v-for="(item_check_out) in $page.props.item_check_outs" :key=item_check_out.id
                class="bg-white p-2 mb-2 border-2 rounded-md border-gray-500 block md:border-none  md:table-row ">
				<td class="text-left  block md:table-cell md:border-none md:bg-blue-100 md:rounded-md"><span class="inline-block w-1/3 md:hidden font-bold">วันที่เบิก</span>{{item_check_out.date_action}}</td>
                <td class="text-left  block md:table-cell md:border-none md:bg-blue-100 md:rounded-md"><span class="inline-block w-1/3 md:hidden font-bold">จำนวน</span>{{item_check_out.item_count}}</td>
                <td class="text-left  block md:table-cell md:border-none md:bg-blue-100 md:rounded-md"><span class="inline-block w-1/3 md:hidden font-bold">ผู้เบิก</span>{{item_check_out.user.name}}</td>
                <td 
                    class="text-left  block md:table-cell md:border-none md:bg-blue-100 md:rounded-md">
                    <span class="inline-block w-1/3 md:hidden font-bold">ผู้เบิก</span>
                    <label for=""  v-if="item_check_out.status != 'active'">{{item_check_out.status}}</label>
                    <!-- <button v-if="item_check_out.status != 'canceled'"
                        class="  bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button> -->
                    <button v-if="item_check_out.status != 'canceled'"
                        class=" ml-3 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </td>
            </tr>
			
		</tbody>
	</table>
    <!-- END table -->
     </AppLayout>
</template>
<script>
//import { ref } from 'vue';
//import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props:{
        stock_item:Array,
        stock:Array,
        item_check_outs:Array,
     },
    data(){
        return{
           
        //    stocks:[
		// 		{code:1,name:'aa' },
		// 		{code:2,name:'bb' },	
		// 		{code:3,name:'cc' },		
		// 	],
        }
    },

    // setup() {
    
    //     return { };
    // },
}

</script>