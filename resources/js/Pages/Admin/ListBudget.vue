<template>
    <AppLayout>
        <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
            <div class=" m-2">
                <label for="">ระบุปีงบประมาณ:</label>
                <select name="" id="" v-model="form.year_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
                    <option v-for="(year,index) in  years" :key=index v-bind:value="year">{{year+543}}</option>
                </select>
            </div>
            
        </div>
        <div>
            <!-- {{stocks[0].budget['budget_add']}}---->
            <!-- {{stocks[4].budget['budget_add']}} -->
            <!-- {{form.year_selected.length}} -->
            <h1 class=" text-center font-bold text-lg">รายการงบประมาณแต่ละสาขา</h1>
            <h1 v-if="form.year_selected" class=" text-center font-bold text-lg">ประจำปีงบประมาณ {{form.year_selected + 543}}</h1>
            <!-- {{budgets}} -->
            <div v-for="(stock,index) in stocks" :key="stock.id" 
              
                >
                <!-- v-if="form.year_selected" -->
                <div 
                    class="  py-2 border-b-2 border-red-300"
                    >
                    <div class="flex justify-between">
                        <div class="">
                           <label class=" font-bold"> {{index+1}}.  {{stock.stockname}}   </label>   
                        </div>
                        <div v-if="stock.budget['budget_add']==0" class=" px-3 bg-green-200 rounded-md">
                            บันทึก
                        </div>
                        <div v-else class=" px-3 bg-yellow-200  rounded-md">
                            แก้ไข
                        </div>
                    </div>
                     <div v-if="stock.budget['budget_add']==0" class=" px-3">
                        <label  class=" px-3">
                            ไม่พบข้อมูลงบประมาณ
                        </label>
                        
                    </div>
                     <div v-else  class=" px-3">
                         <label class=" px-3">
                            ได้อนุมัติ {{stock.budget['budget_add']}} บาท
                        </label>
                    </div>
                    <div>
                      
                        <BudgetOrder  v-for="(order) in stock.orders" :key="order.id" 
                            :orderItem="order"
                            :stockBudget="stock.budget['budget_add']"
                            >
                        </BudgetOrder>
                     
                    </div>
                    <div v-if="stock.budget['budget_add']!=0" class=" px-3">
                          <label class=" px-3"> คงเหลือ {{stock.balance_budget}} บาท</label>
                    </div>
                </div>
              
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BudgetOrder from '@/Components/BudgetOrder.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from '@vue/reactivity';
import { onMounted } from '@vue/runtime-core';


defineProps({
    budgets:{type:Object,required:true},
    stocks:{type:Object},
})

const years=ref([2021,2022])
//const balance_budget = ref(0);
const sum_order = ref(0);
const stock_order = ref('');

const form=useForm({
    year_selected:'',
})

onMounted(() => {
   // console.log('onMounted');
    //console.log('stock_item======'+usePage().props.value.stocks);
    stock_order.value = usePage().props.value.stocks;
  // console.log(stock_order.value);
})

const sumOrder = computed(()=>{
    sum_order.value = 0;
  //   console.log(stock_order.value);
    // stock_order.value.forEach(item => {    
    //              console.log(item);
    //             //sum_order.value += item.timeline['approve_budget'];
    //         })
    // return sum_pay.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "5555";
})
// onMounted(() => {
//     console.log(' mounted!')
    
// })

// const balance_budget=computed(()=>{
//     return 5000;
// })



</script>
