import { reactive } from "vue";

export default reactive({
   items: [
    
  ],
  add(toast) {
    this.items.unshift(toast);
  },
  removeItem(index) {
    this.items.splice(index, 1);
  },
});