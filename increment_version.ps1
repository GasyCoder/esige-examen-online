# Récupérer la version actuelle depuis le fichier .env
$currentVersion = (Get-Content .\.env | Where-Object { $_ -match 'APP_VERSION=(.+)' } | ForEach-Object { $matches[1] })

# Incrémenter la version mineure
$versionParts = $currentVersion.Split('.')
$versionParts[2] = [int]$versionParts[2] + 1
$newVersion = $versionParts -join '.'

# Mettre à jour la version dans le fichier .env
$envContent = (Get-Content .\.env)
$envContent = $envContent | ForEach-Object { $_ -replace 'APP_VERSION=.+', "APP_VERSION=$newVersion" }
Set-Content .\.env $envContent

Write-Host "La version a été mise à jour vers $newVersion"