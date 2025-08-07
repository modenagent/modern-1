# Environment Setup Guide

## 1. Create .env file

Create a `.env` file in your project root with these settings:

```env
# Database Settings
DB_HOST=localhost
DB_USER=your_database_username
DB_PASSWORD=your_database_password
DB_DATABASE=your_database_name

# Application Settings
BASE_URL=http://localhost/modern-1/
ENVIRONMENT=development

# API Keys (Optional for testing)
CHAT_GPT_API_KEY=your_openai_api_key_here
CHAT_GPT_URL=https://api.openai.com/v1/chat/completions
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here
```

## 2. Database Migration

Execute the migration script:

### Using phpMyAdmin:
1. Open phpMyAdmin
2. Select your database
3. Go to Import tab
4. Upload: `database/migrations/001_mobile_and_api_features.sql`
5. Click Go

### Using MySQL Command Line:
```bash
mysql -u username -p database_name < database/migrations/001_mobile_and_api_features.sql
```

## 3. Test the System

1. Open: `http://localhost/modern-1/api_test_browser.html`
2. Test API endpoints
3. Verify mobile functionality

## Next Steps

After successful setup:
1. Test all API endpoints
2. Verify mobile HTML reports
3. Begin FlutterFlow development
