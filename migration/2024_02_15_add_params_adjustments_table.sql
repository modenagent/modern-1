ALTER TABLE lp_params_adjustments
ADD black_knight_beds varchar(50) after black_knight_sqft,
ADD black_knight_baths varchar(50) after black_knight_sqft,
ADD rets_beds varchar(50) after rets_sqft,
ADD rets_baths varchar(50) after rets_sqft;