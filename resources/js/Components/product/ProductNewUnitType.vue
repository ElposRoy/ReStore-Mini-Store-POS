<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineEmits(['closeDialog','categoryUnitTypeSubmitForm'])

defineProps(['categories','dialogUnitType','unit_types']);

let unit_type_form = useForm({
    unit_type: "",
});

</script>
  <!-- CATEGORY DIALOG -->
 <template>
     <v-dialog
  v-model="dialogUnitType"
  max-width="500px"
  persistent
>
  <v-card>
    <v-card-title>
      <span class="text-h5">Add Unit Type</span>
    </v-card-title>

    <v-card-text>
      <form @submit.prevent="submitProducts">
      <v-container>
        <v-row>
          <v-col
            cols="12"
            sm="6"
            md="12"
          >
            <v-text-field
              v-model="unit_type_form.unit_type"
              label="New Unit Type"
              
            ></v-text-field>
            <InputError :message="unit_type_form.errors.unit_type" />
          </v-col>
        </v-row>
      <v-label>EXISTING CATEGORIES</v-label>
          <v-col
            cols="12"
            sm="6"
            md="12"
            class="mx-auto"
          >
          <v-chip 
          class="ma-1"
          v-for="(type,i) in unit_types"
          :unit_types="unit_types"
          >
          
            {{ type.unit_type}} 
              </v-chip>
          </v-col>
        
      </v-container>
      </form>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn
        color="blue-darken-1"
        variant="text"
        @click="$emit('closeDialog')"
      >
        Cancel
      </v-btn>
      <v-btn
        color="blue-darken-1"
        variant="text"
        @click="$emit('categoryUnitTypeSubmitForm',unit_type_form)"
      >
        Save
      </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
 </template>
<!-- CAATEGORY DIALOG -->