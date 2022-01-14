<template>
    <div >
        <label for=""  class=" px-6">
            ORDER NO.: {{orderItem.order_no}}/{{orderItem.year}} DATE ORDER: {{orderItem.date_order}} BUDGET:{{orderItem.timeline['approve_budget']}} Bath.
        </label>
       
    </div>
    <!-- <div class=" px-8">
         คงเหลือ {{balance_budget}} บาท
    </div> -->
</template>
<script setup>
const { ref, computed }=require("@vue/reactivity")

const props = defineProps({
    orderItem:{type:Object,required:true},
    stockBudget:{type:Number,required:true}
})

// const balance=ref(0);

// const balance_budget=computed(()=>{
//     //console.log(props.orderItem.timeline);
//      balance.value = props.stockBudget - props.orderItem.timeline['approve_budget'];
//     return balance.value; 
//     // return props.stockBudget - props.orderItem.timeline['approve_budget'];
//     // return props.stockBudget;
// })
</script>
