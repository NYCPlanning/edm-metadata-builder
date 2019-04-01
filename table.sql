-- Readme Table
CREATE TABLE readme (
uid serial PRIMARY key NOT NULL,
common_name text,
sde_name text,
tags_guide text,
tags_sde text,
summary text,
summary_update_date text,
description text,
description_data_loc text,
data_steward text,
data_engineer text,
credits text,
genconst text,
legconst text,
update_freq text,
date_last_update text,
date_underlying_data text,
data_source text,
version text,
common_uses text,
data_quality text,
caveats text,
future_plans text,
distribution text,
contact text,
date_last_updated text,
dates_input_dataset text,
extent text,
fgdc_geo_format text,
series_name text,
series_issue text,
spatial_repre_type text,
processing_env text,
arcgis_item_prop_name text,
rpoc_contact_position text,
rpoc_address text,
sr_geo_coor_ref text,
sr_projection text,
terms_fees text,
dis_transfer_option_location text,
dis_transfer_option_description text,
responsible_party_name text,
sdp_vector_object_count text,
data_access text
);


-- Maintenance Frequency Table
CREATE TABLE maintfreq (
  maintfreq text,
  tag text
);

INSERT INTO datatype (maintfreq, tag)
VALUES ('monthly', '005'),
       ('biannually', '007'),
       ('annually', '008'),
       ('quarterly', '006'),
       ('daily', '002'),
       ('weekly', '003'),
       ('fortnightly', '004'),
       ('as-needed', '009');


 -- Data Type Table
 -- CREATE TABLE datatype (
 --   datatype text
 -- );
 --
 -- INSERT INTO datatype (datatype)
 -- VALUES ('String'),
 --        ('OID'),
 --        ('Geometry'),
 --        ('Double');
