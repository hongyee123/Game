class Order {
  String id;
  String product_id;
  String user_id;
  String helper_id;
  String type;
  String quantity;
  String price;
  String discount;
  String status;
  String rate;
  String comment;
  String date;
  String rate_time;


  Order(
      {required this.id,
      required this.product_id,
      required this.user_id,
      required this.helper_id,
      required this.type,
      required this.quantity,
      required this.price,
      required this.discount,
      required this.status,
      required this.rate,
      required this.comment,
      required this.date,
      required this.rate_time});

  Order.fromJson(Map<String, dynamic> json) 
    :id = json['id'] ?? '',
    product_id = json['ord_product_id'] ?? '',
    user_id = json['ord_user_id'] ?? '',
    helper_id = json['ord_helper_id'] ?? '',
    type = json['ord_type'] ?? '',
    quantity = json['ord_quantity'] ?? '',
    price = json['ord_price'] ?? '',
    discount = json['ord_discount'] ?? '',
    status = json['ord_status'] ?? '',
    rate = json['ord_rate'] ?? '',
    comment = json['ord_comment'] ?? '',
    date = json['date'] ?? '',
    rate_time = json['rate_time'] ?? '';
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['ord_product_id'] = this.product_id;
    data['ord_user_id'] = this.user_id;
    data['ord_helper_id'] = this.helper_id;
    data['ord_type'] = this.type;
    data['ord_quantity'] = this.quantity;
    data['ord_price'] = this.price;
    data['ord_discount'] = this.discount;
    data['ord_status'] = this.status;
    data['ord_rate'] = this.rate;
    data['ord_comment'] = this.comment;
    data['date'] = this.date;
    data['rate_time'] = this.rate_time;
    return data;
  }
}

