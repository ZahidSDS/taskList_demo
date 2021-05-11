<template>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
            <div class="col-auto mr-auto">
                <input type="checkbox"
                @change="updateCheck()"
                v-model="item.complete" />
                <h4 class='ml-2' style="display: inline; vertical-align: middle;">
                <span :class="[item.complete ? 'completed' : '', 'itemText']">{{item.name}}</span>
                </h4>
                <br /><div class="txt-description">{{item.description}}</div>
            </div>
            <div class="col-auto">
                <button @click="removeItem()" class="trashcan" >
                    <font-awesome-icon icon="trash" />
                </button>
            </div>
            </div>
        </li>
    </ul>

</template>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
</script>
<script>
    export default {
        props: ['item'],
        methods: {
            updateCheck() {
                axios.put('api/task/' + this.item.id, {
                    item: this.item
                })
                .then(response => {
                    if(response.status == 200) {
                        this.$emit('itemchanged');
                        console.log(item);
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            },
            removeItem() {
                axios.delete ('api/task/' + this.item.id)
                .then(response => {
                    if(response.status == 200) {
                        this.$emit('itemchanged');
                    }
                })
                .catch (error => {
                    console.log(error);
                })
            }
        }

    }
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    /* margin-left: 20px; */
}
.item {
    display: flex;
    /* justify-content: center; */
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #FF0000;
    outline: none;
    margin-left: 320px;
}
.txt-description {
    margin-left: 25px;
    vertical-align: middle;
}

ul {
  list-style-type: none;
  list-style-position: outside;
}
</style>
