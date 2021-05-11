<template>
    <div class="row">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="item.name">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" v-model="item.description" placeholder="Enter description">
        </div>
        <button type="submit" class="btn btn-xs pull-right" icon="plus-square"
                    @click="addItem()"
                    :class="[item.name ? 'active': 'inactive', 'btn-default']">Submit
        </button>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                item: {
                    name: ""
                }
            }
        },
        methods: {
            addItem () {
                if(this.item.name == '') {
                    return;
                }
                axios.post('api/task/store', {
                    item: this.item
                })
                .then(response => {
                    if(response.status == 201) {
                        this.item.name = "";
                        this.item.description = "";
                        this.$emit('reloadlist');
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            }
        }
    }
</script>

<style scoped>
    .addItem {
        display: flex;
    }
    input {
        background: #f7f7f7;
        border: 0px;
        outline: none;
        padding: 5px;
        margin-right: 10px;
        width: 95%;
    }
    .active {
        color:rgb(55, 141, 112)
    }
    .inactive {
        color: #999999;
    }
</style>
