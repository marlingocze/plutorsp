module "azure-region" {
  source  = "claranet/regions/azurerm"
  version = "x.x.x"

  azure_region = var.azure_region
}

module "rg" {
  source  = "claranet/rg/azurerm"
  version = "x.x.x"

  location     = module.azure-region.location
  client_name  = var.client_name
  environment  = var.environment
  stack        = var.stack
}

module "run-common" {
  source  = "claranet/run-common/azurerm"
  version = "x.x.x"

  client_name    = var.client_name
  location       = module.azure-region.location
  location_short = module.azure-region.location_short
  environment    = var.environment
  stack          = var.stack

  resource_group_name = module.rg.resource_group_name

  tenant_id = var.azure_tenant_id
}

resource "azurerm_storage_account" "assets_storage" {
  account_replication_type = "LRS"
  account_tier             = "Standard"
  location                 = module.azure-region.location
  name                     = "appserviceassets"
  resource_group_name      = module.rg.resource_group_name
}

resource "azurerm_storage_share" "assets_share" {
  name                 = "assets"
  storage_account_name = azurerm_storage_account.assets_storage.name
  quota                = 50
}

module "app_service_plan" {
  source  = "claranet/app-service-plan/azurerm"
  version = "x.x.x"

  client_name         = var.client_name
  environment         = var.environment
  location            = module.azure-region.location
  location_short      = module.azure-region.location_short
  resource_group_name = module.rg.resource_group_name
  stack               = var.stack

  sku = {
    tier = "Standard"
    size = "S1"
  }

  kind = "Linux"
}

module "app_service" {
  source  = "claranet/app-service-web/azurerm"
  version = "x.x.x"

  client_name         = var.client_name
  environment         = var.environment
  location            = module.azure-region.location
  location_short      = module.azure-region.location_short
  resource_group_name = module.rg.resource_group_name
  stack               = var.stack

  app_service_plan_id = module.app_service_plan.app_service_plan_id

  app_settings = {
    foo = "bar"
  }

  auth_settings = {
    enabled             = true
    token_store_enabled = true

    active_directory = {
      client_id         = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
      client_secret     = "xxxxxxxxxxxxxxxxxxxxx"
      allowed_audiences = ["https://www.example.com"]
    }
  }

  custom_domains = {
  # Custom domain with SSL certificate file
    "example.com" = {
      certificate_file     = "./example.com.pfx"
      certificate_password = "xxxxxxxxx"
    }
  # Custom domain with SSL certificate stored in a keyvault
    "example.com" = {
      certificate_keyvault_id = data.azurerm_key_vault_secret.my_keyvault.id
    }
  # Custom domain without SSL certificate
    "example2.com" = null
  }

  extra_tags = {
    foo = "bar"
  }

  mount_points = [
    {
      account_name = azurerm_storage_account.assets_storage.name
      share_name   = azurerm_storage_share.assets_share.name
      access_key   = azurerm_storage_account.assets_storage.primary_access_key
      mount_path   = "/var/www/html/assets"
    }
  ]

  logs_storage_account_id = module.run-common.logs_storage_account_id
}