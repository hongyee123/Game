class Cart {
  String id;
  String cart_username;
  String cart_product;
  String cart_quantity;
  

  Cart(
      {required this.id,
      required this.cart_username,
      required this.cart_product,
      required this.cart_quantity
      });

  Cart.fromJson(Map<String, dynamic> json) 
    :id = json['id'],
    cart_username = json['cart_username'],
    cart_product = json['cart_product'],
    cart_quantity = json['cart_quantity'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['cart_username'] = this.cart_username;
    data['cart_product'] = this.cart_product;
    data['cart_quantity'] = this.cart_quantity;
    return data;
  }
}

