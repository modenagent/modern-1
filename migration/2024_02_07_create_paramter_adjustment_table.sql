CREATE TABLE lp_params_adjustment ( 
  id int(11)  UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  black_knight_radius VARCHAR( 30 ) NOT NULL , 
  black_knight_sqft VARCHAR( 50 ) NULL , 
  rets_radius VARCHAR( 50 ) NULL , 
  rets_sqft VARCHAR( 50 ) NULL, 
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id) ,
  KEY (id)
)