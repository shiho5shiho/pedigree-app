# ER図（v1）

```mermaid
erDiagram
  USERS ||--o| PEOPLE : "linked_to"
  PEOPLE ||--o{ PEOPLE : "biological_father_id / mother_id"
  PEOPLE ||--o{ PERSON_MEDICAL_HISTORIES : has
  MEDICAL_CONDITIONS ||--o{ PERSON_MEDICAL_HISTORIES : "is_type_of"

  USERS {
    bigint id PK
    string name
    string email
    string password
  }
  
  PEOPLE {
    bigint id PK
    bigint user_id FK
    string last_name
    string first_name
    enum biological_sex
    date birth_date
    boolean is_deceased
    bigint biological_father_id FK
    bigint biological_mother_id FK
    boolean is_adopted
  }
  MEDICAL_CONDITIONS {
    bigint id PK
    string name
    string category
  }
  PERSON_MEDICAL_HISTORIES {
    bigint id PK
    bigint person_id FK
    bigint medical_condition_id FK
    enum status
    integer onset_age
    date diagnosed_date
  }
  ```
