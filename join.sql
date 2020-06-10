use mohsen;

create view fullOrder as select * from orders join addProduct on oreders.PRODUCT_ID = addProduct.id;