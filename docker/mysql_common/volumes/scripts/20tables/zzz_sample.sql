CREATE TABLE zzz_sample( 
    zzz_sample_id bigint
    , zzz_sample_cd VARCHAR (8) NOT NULL
    , name VARCHAR (255) NOT NULL
    , kind CHAR (5)
    , lock_version INT NOT NULL DEFAULT 1
    , created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    , created_by bigint NOT NULL DEFAULT 0
    , updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    , updated_by bigint NOT NULL DEFAULT 0
    , PRIMARY KEY (zzz_sample_id)
);
