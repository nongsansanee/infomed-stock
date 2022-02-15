<template>
    <AppLayout>
        <div class=" w-full flex justify-center">
                <label class="text-lg font-bold">รายการใบสั่งซื้อ</label>
        </div>
        <div class="flex flex-col  mb-2 text-md font-bold text-gray-900 ">
            <div class=" m-2">
                <label for="">ระบุปีงบประมาณ:</label>
                <select name="" id="" v-model="form.year_selected"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 pr-6 rounded shadow leading-tight focus:outline-none focus:shadow-outline" 
                    @Change="getListPurchase"
                    >
                    <option v-for="(year,index) in  years" :key=index v-bind:value="year">{{year+543}}</option>
                </select>
            </div>
            
        </div>
        <div class=" w-full  py-4">
            <div v-for="(purchase_order) in purchase_orders" :key="purchase_order.id"
                class=" m-2 p-2 bg-pink-100 border-b-2 border-pink-600 rounded-md"
                >
                <div class=" py-2 font-bold"> {{purchase_order.stock['stockname']}}</div>
                <div class="flex justify-between"> 
                    <p class=" text-red-700 font-bold">วันที่สั่งซื้อ:{{purchase_order.date_order}} </p> 
                    <p class=" bg-green-200 px-2 mx-4 text-red-700 font-bold rounded-md" >
                         สถานะ:{{purchase_order.status}}
                    </p>
                </div>
                <div> ๑.ชื่อโครงการ:{{purchase_order.project_name}} จำนวน {{purchase_order.items.length}} รายการ</div>
                <div> ๒.วงเงินงบประมาณที่ได้รับจัดสรร:{{purchase_order.budget}} บาท</div>
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <p class=" text-green-600 font-bold" > คุณ{{purchase_order.user.name}} ({{purchase_order.user.profile['division_name']}})</p>
                    <p class=" px-2 text-gray-600 text-sm">ผู้บันทึกข้อมูล</p>
                </div>
                <div>
                    <a :href="route('print-purchase-order',purchase_order.id)" 
                        v-if="$page.props.auth.user.profile.division_id==purchase_order.unit_id"
                         target="blank">
                        <span
                            class="inline-flex text-sm py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์แบบ บก.๐๖
                        </span>
                    </a>
                    <a :href="route('print-purchase-order-item',purchase_order.id)"  target="blank">
                        <span
                            class="inline-flex text-sm  md:ml-2 py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                พิมพ์รายการพัสดุสั่งซื้อ
                        </span>
                    </a>
                    <!-- <a :href="route('print-purchase-order-item',purchase_order.id)"  target="blank">
                        <span
                            class="inline-flex text-sm  md:ml-2 py-1 px-2  leading-5 text-white bg-blue-500 rounded-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                                ส่งให้สำนักงานภาคฯ
                        </span>
                    </a> -->
                 <!-- {{$page.props.auth.user.profile.division_id}} and {{purchase_order.unit_id}} -->
                         <button v-if="purchase_order.status == 'created' &&  
                                $page.props.auth.user.profile.division_id==purchase_order.unit_id"
                            class=" inline-flex text-sm ml-3 bg-green-500 hover:bg-green-700 text-white  py-1 px-2 border border-green-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            ส่งเอกสาร
                        </button>
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
  years:{type:Object,required:true},
})

const purchase_orders = ref('');
const form = useForm({
    year_selected:'',
})


const getListPurchase=()=>{
    //console.log('getListPurchase');
    axios.get(route('get-purchase-order',{year:form.year_selected})).then(res => {
       // console.log(res.data.stocks);
        purchase_orders.value = res.data.purchase_orders;   
    });
   // forceUpdate();
}
</script>