import { storeToRefs } from "pinia";
import { useStoreCart } from "../stores/cart";
import { useRouter } from "vue-router";
import useLocation from "./useLocation";
import { toast } from "vue3-toastify";

const useCart = () => {
  const router = useRouter();
  const storeCart = useStoreCart();

  const { products, subtotal, deliveryCost, promotionalDiscount, address } =
    storeToRefs(storeCart);

  const { selectedDestination } = useLocation();

  const addProductToCart = (product, quantity) => {

    const productInCart = products.value.filter(pro => pro.product.producto_id == product.producto_id)

    if (productInCart.length > 0) {
      toast.error("Producto ya se encuentra en el carrito de compra");
      return;
    }

    if (quantity > product.total_existencia) {
      toast.error('No es posible agregar más productos de los existentes.');
      return;
    }

    // Adding product to cart
    products.value.push({
      product,
      quantity,
    });

    localStorage.setItem('products', JSON.stringify(products.value))

    calculateSubtotal();

    toast.success("Producto agregado al carrito");
  };

  const calculateSubtotal = () => {
    subtotal.value = 0;

    products.value.forEach((item) => {
      // console.log(item.product.precios);
      subtotal.value += item.product.precios.final_price * item.quantity;
    });

    // calculateDeliveryCost();
    // if (deliveryCost.value > 0) {
    //   subtotal.value += deliveryCost.value;
    // }

    if (promotionalDiscount.value > 0) {
      subtotal.value -= promotionalDiscount.value;
    }
  };

  const deleteProductFromCart = (index) => {
    // Deleting product from cart
    products.value.splice(index, 1);

    calculateSubtotal();
  };

  const calculateDeliveryCost = () => {
    if (!selectedDestination.value) {
      return;
    }

    // console.log(selectedDestination.value.distance);
    switch (true) {
      case selectedDestination.value.distance < 5000:
        deliveryCost.value = 30.0;
        break;
      default:
        deliveryCost.value = 0.0;
    }
  };

  const clearCart = () => {
    products.value = [];
    subtotal.value = 0.0;
    deliveryCost.value = (0.0).toFixed(2);
    promotionalDiscount.value = (0.0).toFixed(2);
    address.value = "";
    selectedDestination.value = null;
    localStorage.removeItem('products');
  }

  const applyPromotionalCode = () => {
    // TODO
  };

  return {
    products,
    subtotal,
    deliveryCost,
    promotionalDiscount,
    address,

    addProductToCart,
    calculateSubtotal,
    deleteProductFromCart,
    calculateDeliveryCost,
    applyPromotionalCode,
    clearCart,
  };
};

export default useCart;
