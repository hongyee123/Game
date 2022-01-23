class Notice {
  String notice_id;
  String title;
  String contant;
  String 	status;
  String date;
  String create_by;

  Notice(
      {required this.notice_id,
      required this.title,
      required this.contant,
      required this.status,
      required this.date,
      required this.create_by
      });

  Notice.fromJson(Map<String, dynamic> json) 
    :notice_id = json['notice_id'],
    title = json['title'],
    contant = json['contant'],
    status = json['status'],
    date = json['date'],
    create_by = json['create_by'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['notice_id'] = this.notice_id;
    data['title'] = this.title;
    data['contant'] = this.contant;
    data['status'] = this.status;
    data['date'] = this.date;
    data['create_by'] = this.create_by;
    return data;
  }
}

