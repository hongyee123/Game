class Detail {
  String id;
  String ord_product_id;
  String ord_user_id;
  String ord_helper_id;
  String ord_type;
  String ord_quantity;
  String ord_price;
  String ord_discount;
  String ord_status;
  String ord_rate;
  String ord_comment;
  

  Detail(
      {required this.id,
      required this.ord_product_id,
      required this.ord_user_id,
      required this.ord_helper_id,
      required this.ord_type,
      required this.ord_quantity,
      required this.ord_price,
      required this.ord_discount,
      required this.ord_status,
      required this.ord_rate,
      required this.ord_comment
      });

  Detail.fromJson(Map<String, dynamic> json) 
    :id = json['id'],
    ord_product_id = json['ord_product_id'],
    ord_user_id = json['ord_user_id'],
    ord_helper_id = json['ord_helper_id'],
    ord_type = json['ord_type'],
    ord_quantity = json['ord_quantity'],
    ord_price = json['ord_price'],
    ord_discount = json['ord_discount'],
    ord_status = json['ord_status'],
    ord_rate = json['ord_rate'],
    ord_comment = json['ord_comment'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['ord_product_id'] = this.ord_product_id;
    data['ord_user_id'] = this.ord_user_id;
    data['ord_helper_id'] = this.ord_helper_id;
    data['ord_type'] = this.ord_type;
    data['ord_quantity'] = this.ord_quantity;
    data['ord_price'] = this.ord_price;
    data['ord_discount'] = this.ord_discount;
    data['ord_status'] = this.ord_status;
    data['ord_rate'] = this.ord_rate;
    data['ord_comment'] = this.ord_comment;
    return data;
  }
}

