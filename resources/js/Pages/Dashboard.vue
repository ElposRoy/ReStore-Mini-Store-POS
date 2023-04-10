<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<script>

export default{
  data(){
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
        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <v-container class="">
                    <v-row no-gutters>
                        <v-card
            color="#1F7087"
            theme="dark"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="text-h5">
                 PRODUCTS
                </v-card-title>

                <v-card-subtitle>Collection of products</v-card-subtitle>

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
                <v-img :src="baseurl+'/images/Archive.png'"></v-img>
              </v-avatar>
            </div>
          </v-card>
                    </v-row>

                    
                </v-container>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4">
                    <v-container>
                        <v-row>
                            <v-card
    class="mx-auto"
    max-width="400"
  >
    <v-img
      class="align-end text-white"
      height="200"
      src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
      cover
    >
      <v-card-title>Top 10 Australian beaches</v-card-title>
    </v-img>

    <v-card-subtitle class="pt-4">
      Number 10
    </v-card-subtitle>

    <v-card-text>
      <div>Whitehaven Beach</div>

      <div>Whitsunday Island, Whitsunday Islands</div>
    </v-card-text>

    <v-card-actions>
      <v-btn color="orange">
        Share
      </v-btn>

      <v-btn color="orange">
        Explore
      </v-btn>
    </v-card-actions>
              
  </v-card>

                    <v-card
                        class="mx-auto"
                        max-width="400"
                    >
                        <v-img
                        class="align-end text-white"
                        height="200"
                        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                        cover
                        >
                        <v-card-title>Top 10 Australian beaches</v-card-title>
                        </v-img>

                        <v-card-subtitle class="pt-4">
                        Number 10
                        </v-card-subtitle>

                        <v-card-text>
                        <div>Whitehaven Beach</div>

                        <div>Whitsunday Island, Whitsunday Islands</div>
                        </v-card-text>

                        <v-card-actions>
                        <v-btn color="orange">
                            Share
                        </v-btn>

                        <v-btn color="orange">
                            Explore
                        </v-btn>
                        </v-card-actions>
                    </v-card>

                        <v-card
                            class="mx-auto"
                            max-width="400"
                        >
                            <v-img
                            class="align-end text-white"
                            height="200"
                            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                            cover
                            >
                            <v-card-title>Top 10 Australian beaches</v-card-title>
                            </v-img>

                            <v-card-subtitle class="pt-4">
                            Number 10
                            </v-card-subtitle>

                            <v-card-text>
                            <div>Whitehaven Beach</div>

                            <div>Whitsunday Island, Whitsunday Islands</div>
                            </v-card-text>

                            <v-card-actions>
                            <v-btn color="orange">
                                Share
                            </v-btn>

                            <v-btn color="orange">
                                Explore
                            </v-btn>
                            </v-card-actions>
                        </v-card>

                        </v-row>
                      
  
                    </v-container>
                    
                    </div>
            </div>
        </div>
        <!-- Main Content -->
    </AuthenticatedLayout>
</template>
