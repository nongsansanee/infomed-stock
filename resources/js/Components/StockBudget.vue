<template>
          <div 
            >
            <!-- v-if="form.year_selected" -->
            <div 
                class="  py-2 border-b-2 border-red-300"
                >
                <div class="flex justify-between">
                    <div class="">
                        <label class=" font-bold"> {{stockIndex+1}}.  {{stockBudget.stockname}}   </label>   
                    </div>
                    <!-- <div v-if="stockBudget.budget['budget_add']==0" class=" px-3 bg-green-200 rounded-md">
                        บันทึก
                    </div>
                    <div v-else class=" px-3 bg-yellow-200  rounded-md">
                        แก้ไข
                    </div> -->
                </div>
                <!-- {{stockBudget}} -->
                <div v-if="stockBudget.budget['budget_add']==0" 
                    class="flex justify-between px-3 " >
                        <!-- <div class="px-3">
                            <label  class=" ">
                            ไม่พบข้อมูลงบประมาณ
                            </label>
                           
                        </div> -->
                        <div>
                             <label  class=" ">
                            ระบุงบประมาณ:
                            </label>
                             <input type="number" 
                                class=" rounded-md "
                                v-model="form.budget_input"
                                >
                        </div>
                        <div  class=" p-2 ">
                            <!-- บันทึก -->
                              <button
                                class=" flex justify-center px-2 bg-green-200 text-green-900 rounded-md shadow-md hover:bg-green-300 focus:outline-none"
                                v-on:click="addBudget()"
                                >
                                บันทึก
                            </button>
                        </div>
                </div>
                <div v-if="stockBudget.budget['budget_add']!=0"  
                    class="flex justify-between px-3 ">
                    <div>
                         <label class=" px-3 text-green-600 font-bold">
                        ได้อนุมัติ  {{budget_add}} บาท 
                        </label>
                    </div>
                    <div class="flex px-3 ">
                        <div v-if="stockBudget.budget['budget_add']!=0 && stockBudget.orders.length==0" 
                            class="px-3  bg-yellow-200  rounded-md">
                            แก้ไข
                        </div>
                        <div v-if="stockBudget.orders.length>0" class="flex  rounded-md">
                            <button
                                class=" flex justify-center px-2 bg-blue-200 text-blue-900 rounded-md shadow-md hover:bg-blue-300 focus:outline-none"
                                v-on:click="viewAllOrder()"
                                >
                                ดูรายการเบิก
                            </button>
                            <!-- <button
                                class=" flex justify-center px-2 ml-2 bg-blue-200 text-blue-900 rounded-md shadow-md hover:bg-blue-300 focus:outline-none"
                                >
                                เพิ่มงบประมาณ
                            </button> -->
                        </div>
                        
                    </div>
                    
                </div>
                <div v-if="view_order">
                    <!-- {{stockBudget.orders.length}} -->
                    <BudgetOrder  v-for="(order,index) in stockBudget.orders" :key="order.id" 
                        :orderIndex="index"
                        :orderItem="order"
                        :stockBudget="stockBudget.budget['budget_add']"
                        >
                    </BudgetOrder>
                    <!-- {{budgetYear}} -->
                    <!-- :href="route('print-budget-order',stockBudget.id,budgetYear)" -->
                     <a :href="route('print-budget-order',{stock_id:stockBudget.id,year:budgetYear})" target="blank" class=" mx-6">
                        <span
                            class="inline-flex text-sm py-1 px-3  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์
                        </span>
                    </a>
                </div>
                <div v-if="stockBudget.budget['budget_add']!=0" class=" px-3">
                    <label class=" px-3 text-red-600 font-bold"> 
                        คงเหลือ  {{budget_balance}}บาท
                    </label>
                </div>
            </div>
        </div>
    
</template>
<script setup>
import BudgetOrder from '@/Components/BudgetOrder.vue';
import { useForm } from '@inertiajs/inertia-vue3';
const { ref, computed }=require("@vue/reactivity")
const { onMounted, watch }=require("@vue/runtime-core")

const props = defineProps({
    stockIndex:{type:Number,required:true},
    stockBudget:{type:Object,required:true},
    budgetYear:{type:Number,required:true},
})

//const budget_add = ref(0);
//const budget_balance = ref(0);
const view_order=ref(false);

const form = useForm({
    budget_input:{type:Number,defaulte:0}
})


const budget_add = computed(()=>{
    return  props.stockBudget.budget['budget_add'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
})

const budget_balance = computed(()=>{
     if(props.stockBudget.budget['budget_add']!=0){
      //  console.log('balance_budget-->'+props.stockBudget.balance_budget);
       return  props.stockBudget.balance_budget.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       // console.log(budget_balance.value);
    }else{
        return '0';
    }
})

const viewAllOrder=()=>{
    view_order.value=!view_order.value;
}

const addBudget=()=>{
    console.log('addBudget');
    console.log(props.stockBudget.id);
    console.log(props.budgetYear);
    console.log(form.budget_input)
}
</script>
