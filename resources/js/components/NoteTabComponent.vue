<template>
  <v-card>
    <v-toolbar
      color="grey lighten-1"
      light
      flat
    >
      <template v-slot:extension>
          <!--Selected-->
        <v-tabs
          v-model="tab"
          align-with-title
          color="black"
        >
          <v-tabs-slider color="red"></v-tabs-slider>

          <v-tab
            v-for="item in items"
            :key="item"
            
          >
            {{ item }}
          </v-tab>
        </v-tabs>
      </template>
    </v-toolbar>

    <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
        <v-card flat>
          <v-card-text
            v-for="itemText in myStudentSelection.attendance"
            :key="itemText.id"
            v-if="item=='Events'"
          >
          <ul>
                    <li>
                      {{itemText.event_start_date | formatDate}} - {{itemText.event_name}}
                    </li>
          </ul>
          <!-- {{myStudentSelection.student_notes}} -->
          </v-card-text>
          <v-card-text
            v-if="item=='Notes'"
          >
          <ul>
                    <li>
                     {{myStudentSelection.student_notes}}
                    </li>
          </ul>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>
</template>

<script>
    export default {
        mounted() {
            console.log('NoteTab Component mounted.')
        },
      props: ['myStudentSelection'],
      data () {
      return {
        tab: null,
        items: [
          'Notes','Events', 'Student Coaching'
        ],
        itemText:[
          'item1',
          'item2',
          'item3'
        ]

        //text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      }
    },
    }
</script>
