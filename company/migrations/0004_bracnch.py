# Generated by Django 4.1.7 on 2023-03-07 06:49

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ("company", "0003_alter_company_table"),
    ]

    operations = [
        migrations.CreateModel(
            name="Bracnch",
            fields=[
                (
                    "id",
                    models.BigAutoField(
                        auto_created=True,
                        primary_key=True,
                        serialize=False,
                        verbose_name="ID",
                    ),
                ),
                ("name", models.CharField(max_length=30)),
                ("arabic_name", models.CharField(max_length=30)),
                ("contact", models.CharField(max_length=40)),
                ("email", models.EmailField(max_length=254)),
                ("address", models.TextField()),
                ("vat_number", models.CharField(max_length=30)),
                ("vat", models.FloatField()),
                ("logo", models.TextField()),
            ],
            options={
                "db_table": "Branch",
            },
        ),
    ]
