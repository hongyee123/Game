class Cart {
  String type;
  String cart_price;
  String cart_quantity;
  String username;
  

  Cart(
      {required this.type,
      required this.cart_price,
      required this.cart_quantity,
      required this.username
      });

  Cart.fromJson(Map<String, dynamic> json) 
    :type = json['type'],
    cart_price = json['price'],
    cart_quantity = json['cart_quantity'],
    username = json['username'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['type'] = this.type;
    data['price'] = this.cart_price;
    data['cart_quantity'] = this.cart_quantity;
    data['username'] = this.username;
    return data;
  }
}

