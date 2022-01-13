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
            1-- {{stocks[0].budget['budget_add']}}----
            4--{{stocks[4].budget['budget_add']}}
            <!-- {{form.year_selected.length}} -->
            <h1 class=" text-center font-bold text-lg">รายการงบประมาณแต่ละสาขา</h1>
            <h1 v-if="form.year_selected" class=" text-center font-bold text-lg">ประจำปีงบประมาณ {{form.year_selected + 543}}</h1>
            <!-- {{budgets}} -->
            <div v-for="(stock,index) in stocks" :key="stock.id" 
              
                >
                <div v-if="form.year_selected"
                    class="  py-2 border-b-2 border-red-300"
                    >
                    <div class="flex justify-between">
                        <div class="">
                           <label class=" font-bold"> {{index+1}}.  {{stock.stockname}}   </label>   
                        </div>
                        <div class=" px-3 bg-green-200 rounded-md">
                            แก้ไข
                        </div>
                    </div>
                     <!-- <div v-if="stock.budget['budget_add']=0.00" class=" px-3">
                        <label  class=" px-3">
                            ไม่พบข้อมูลงบประมาณ
                        </label>
                        
                    </div> -->
                     <div  class=" px-3">
                         <label class=" px-3">
                            ได้อนุมัติ {{stock.budget['budget_add']}} บาท
                        </label>
                    </div>
                    <div class=" px-3">
                          <label class=" px-3"> คงเหลือ 400,000 บาท</label>
                    </div>
                </div>
              
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';

defineProps({
    budgets:{type:Object,required:true},
    stocks:{type:Object},
})

const years=ref([2021,2022])

const form=useForm({
    year_selected:'',
})
</script>
