<script>
export default{
    data() {
    return ({
        baseurl: location.origin
    })
  },
  
}
</script>
<template>
  <img :src="baseurl+'/images/Logo.png'" class="w-40 h-40">
</template>
