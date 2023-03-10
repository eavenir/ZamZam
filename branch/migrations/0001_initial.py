# Generated by Django 4.1.7 on 2023-03-10 19:55

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name="Branch",
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
                ("user", models.ManyToManyField(to=settings.AUTH_USER_MODEL)),
            ],
            options={
                "db_table": "branch",
            },
        ),
        migrations.CreateModel(
            name="Employee",
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
                ("father_name", models.CharField(max_length=30)),
                ("date_of_birth", models.DateField()),
                ("nic", models.CharField(max_length=20)),
                ("category", models.CharField(max_length=20)),
                ("contact", models.CharField(max_length=20)),
                ("address", models.TextField()),
                ("balance", models.FloatField()),
                ("basic_salary", models.FloatField()),
                ("transport_allowance", models.FloatField()),
                ("food_allowance", models.FloatField()),
                ("accommodation_allowance", models.FloatField()),
                ("pr_allowance", models.FloatField()),
                ("extra_allowance", models.FloatField()),
                ("working_hours", models.FloatField()),
                ("hiring_date", models.DateField()),
                ("fire_date", models.DateField()),
                ("nationality", models.CharField(max_length=20)),
                ("passport_number", models.CharField(max_length=30)),
                ("passport_expiry_date", models.DateField()),
                ("work_permit", models.CharField(max_length=30)),
                ("work_permit_expiry_date", models.DateField()),
                ("driving_license", models.CharField(max_length=30)),
                ("driving_license_expiry_date", models.DateField()),
                ("municipality_card", models.CharField(max_length=30)),
                ("municipality_card_expiry_date", models.DateField()),
                (
                    "branch",
                    models.ForeignKey(
                        on_delete=django.db.models.deletion.PROTECT, to="branch.branch"
                    ),
                ),
            ],
            options={
                "db_table": "employee",
            },
        ),
    ]
