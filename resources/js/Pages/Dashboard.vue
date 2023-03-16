<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

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
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">R.E. STORE SALES ACTIVITY</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <!-- Main -->
                    <v-container class="">
                        <v-card >
    <v-container>
        <v-row>
            <!-- Left Side -->
            <v-col cols="4">
                <v-row dense>
        <v-col cols="12">
            <v-card
            color="#385F73"
            theme="dark"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="text-h5">
                  Printing Services
                </v-card-title>

                <v-card-subtitle>Record of your prints</v-card-subtitle>

                <v-card-actions>
                  <v-btn
                    class="ms-2"
                    variant="outlined"
                    size="small"
                  >
                   Record
                  </v-btn>
                </v-card-actions>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                rounded="0"
              >
                <v-img :src="baseurl+'/images/PrinterIcon.png'"></v-img>
              </v-avatar>
            </div>
          </v-card>

        </v-col>

        <v-col cols="12">
          <v-card
            color="#1F7087"
            theme="dark"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="text-h5">
                  School Supplies
                </v-card-title>

                <v-card-subtitle>Record of school supplies</v-card-subtitle>

                <v-card-actions>
                  <v-btn
                    class="ms-2"
                    variant="outlined"
                    size="small"
                  >
                    Record
                  </v-btn>
                </v-card-actions>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                rounded="0"
              >
              <v-img :src="baseurl+'/images/SchoolSupply.png'"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>

        <v-col cols="12">
          <v-card
            color="#952175"
            theme="dark"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="text-h5">
                  Groceries
                </v-card-title>

                <v-card-subtitle>Grocery Records</v-card-subtitle>

                <v-card-actions>
                  <v-btn
                    class="ms-2"
                    variant="outlined"
                    size="small"
                  >
                    Record
                  </v-btn>
                </v-card-actions>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                rounded="0"
              >
              <v-img :src="baseurl+'/images/Groceries.png'"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>

        <v-col cols="12">
          <v-card
            color="#2596be"
            theme="dark"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="text-h5">
                  GCASH
                </v-card-title>

                <v-card-subtitle>Record your Gcash</v-card-subtitle>

                <v-card-actions>
                  <v-btn
                    class="ms-2"
                    variant="outlined"
                    size="small"
                  >
                    Record
                  </v-btn>
                </v-card-actions>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                rounded="0"
              >
              <v-img :src="baseurl+'/images/Gcash.png'"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>
      </v-row>
            </v-col>
                <!--  Left Side-->

                 <!-- RightSide -->
            <v-col  cols="8">

                <v-card  class="mb-2" prepend-icon="mdi-home">
                <template v-slot:title>
                This is a title
                </template>

                <v-card-text>
                This is content
                </v-card-text>
            </v-card>

            <v-card  class="mb-2" prepend-icon="mdi-home">
                <template v-slot:title>
                This is a title
                </template>

                <v-card-text>
                This is content
                </v-card-text>
            </v-card>
            </v-col>
            <!-- RightSide -->
        </v-row>
    
      
    </v-container>
    
                        </v-card>
                        
                    </v-container>
                    <!-- Main-->
                    
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
