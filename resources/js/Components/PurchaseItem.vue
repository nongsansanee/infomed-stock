<template>
    <div class=" my-2 p-2 bg-blue-100 rounded-md ">
        <div class="flex justify-start ">
                <label class=" text-lg font-bold text-red-600" >เพิ่มรายการพัสดุให้ครบก่อนกดปุ่มบันทึกใบสั่งซื้อ:</label>
        </div>
        <div class=" w-full block ">
                 <!-- <svg xmlns="http://www.w3.org/2000/svg" v-if="business_alert" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg> -->
                <label >ชื่อบริษัทผู้ขาย:</label>
                <input type="text" name="" id=""
                        v-model="form.business"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[business_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
                <label >รายการ:</label>
                <input type="text" name="" id=""
                        v-model="form.item"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[item_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
                <label >Material:</label>
                <input type="text" name="" id=""
                        v-model="form.material"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[material_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
                <label >จำนวน:</label>
                <input type="number" name="" id=""
                        v-model="form.unit_purchase"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[unit_purchase_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
                <label >หน่วย:</label>
                <input type="text" name="" id=""
                        v-model="form.unit_count"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[unit_count_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
                    <label >ราคา/หน่วย:</label>
                <input type="number" name="" id=""
                        v-model="form.unit_price"
                        class="w-full  py-2 rounded-md appearance-none focus:border-indigo-600 "
                        :class="[unit_price_alert ? 'border-red-500 border-2 ' : 'border-gray-500' ]"
                    >
        </div>
        <div class=" m-2 p-2">
                    
            <button
                class="w-full flex  p-2 justify-center text-sm  text-white bg-blue-600 rounded-md hover:bg-blue-400 focus:outline-none"
                @click="addOrder"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              เพิ่มรายการ
            </button>
        </div>   
        
    </div>
</template>
<script setup>
const { useForm }=require("@inertiajs/inertia-vue3");
const { ref }=require("@vue/reactivity");

const emits = defineEmits(['previewOrder'])
const form = useForm({
    item:' Mannitol Salt Agar',
    material:'30029883',
    business:'บจ. เมดิคอล ทดสอบ จำกัด',
    unit_purchase:5,
    unit_count:'pack',
    unit_price:2000.0,

    // item:'',
    // material:'',
    // business:'',
    // unit_purchase:0,
    // unit_count:'',
    // unit_price:0.0,
    preview_orders: Array,
})

const total_bath=ref(0);
const business_alert=ref(false);
const item_alert=ref(false);
const material_alert=ref(false);
const unit_count_alert=ref(false);
const unit_price_alert=ref(false);
const unit_purchase_alert=ref(false);

const addOrder=()=>{
    //validate

    if(form.business.length==0){
            business_alert.value = true;
            return false;
    }else{
            business_alert.value = false;
    }

    if(form.item.length==0){
            item_alert.value = true;
            return false;
    }else{
            item_alert.value = false;
    }

    if(form.material.length==0){
            material_alert.value = true;
            return false;
    }else{
            material_alert.value = false;
    }
    if(form.unit_purchase==0){
            unit_purchase_alert.value = true;
            return false;
    }else{
            unit_purchase_alert.value = false;
    }
    if(form.unit_count.length==0){
            unit_count_alert.value = true;
            return false;
    }else{
            unit_count_alert.value = false;
    }
    if(form.unit_price==0){
            unit_price_alert.value = true;
            return false;
    }else{
            unit_price_alert.value = false;
    }

    //end validate
    form.preview_orders=[]
    total_bath.value = form.unit_purchase * form.unit_price;
    let show_total_bath =  total_bath.value.toFixed(2);
   // console.log('show_total_bath=='+show_total_bath);
   // return show_total_bath.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    form.preview_orders.push({
                                item_name:form.item,
                                material:form.material,
                                order_input:form.unit_purchase,
                                unit_count:form.unit_count,
                                price:form.unit_price,
                                business_name:form.business,
                                total:show_total_bath,
                            });
    //console.log(form.preview_orders)
    emits('previewOrder',  form.preview_orders);
}
</script>
