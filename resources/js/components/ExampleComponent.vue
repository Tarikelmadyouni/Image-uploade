<template>
    <div class="container">


        <div  class ="row justify-content-center mb-3" ref="imageUpload">
        
    <div class="col-12 bg-dark text-white rounded py-3 my-2 text-center">DEPOSER IMAGE(S) ICI
        </div>  
    </div>  
</div>
</template>

<script>

     import dropzone from 'dropzone'; 

    export default {

             data:function(){

                 return{

                    dropzone:null 

                 }

             },        
        mounted() {
             
               this.dropzone = new dropzone(this.$refs.imageUpload, {
                      
                          url: '/api/images'
               });
        }
    }
</script>
