<template>
  <div id="commentForm" class="box has-shadow has-background-white">

    <form @keyup.enter="postComment">
          <div class="field has-margin-top">

            <div class="field has-margin-top">
              <label class="label">Your comment</label>
              <div class="control">
                <textarea
                    style="height:100px;"
                    name="comment"
                    class="input is-medium" autocomplete="true" v-model="body"
                    placeholder="lorem ipsum"></textarea>
              </div>

            </div>
            <div class="control has-margin-top">
              <button style="background-color: #47b784" :class="{'is-loading': submit}"
                      class="button has-shadow is-medium has-text-white"
                      :disabled="!isValid"
                      @click.prevent="postComment"
                      type="submit"> Submit
              </button>
            </div>
          </div>
    </form>

  </div>
</template>

<script>
    export default {
        name: "NewComment",
        props: ["postId", "userId"],
        data() {
          return {
            submit: false,
            body: '',
          }
        },
        methods: {
          postComment() {
            this.submit = true;
            const res = { 
                comment: this.body,
                post_id: this.postId,
                user_id: this.userId
            };

            axios.post('/api/comment', res)
                .then(response => {
                    this.submit = false;
                    if (response.data === 'ok')
                        console.log('success')
                    }).catch(err => {
                    this.submit = false
                })
            },
        },
        computed: {
            isValid() {
                return this.body !== '';
            }
        }
    }
</script>

<style scoped>
    .has-margin-top {
        margin-top: 15px;
    }

</style>