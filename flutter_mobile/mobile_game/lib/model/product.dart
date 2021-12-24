class Product {
  String id;
  String username;
  String type;
  String price;
  String quantity;
  String available;
  String description;

  Product(
      {required this.id,
      required this.username,
      required this.type,
      required this.price,
      required this.quantity,
      required this.available,
      required this.description});

  Product.fromJson(Map<String, dynamic> json) 
    :id = json['id'],
    username = json['username'],
    type = json['type'],
    price = json['price'],
    quantity = json['quantity'],
    available = json['available'],
    description = json['description'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['username'] = this.username;
    data['type'] = this.type;
    data['price'] = this.price;
    data['quantity'] = this.quantity;
    data['available'] = this.available;
    data['description'] = this.description;
    return data;
  }
}

