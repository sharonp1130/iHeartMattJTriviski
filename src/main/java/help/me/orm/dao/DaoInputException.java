package help.me.orm.dao;

public class DaoInputException extends Exception {

	public DaoInputException() {
		super();
	}

	public DaoInputException(String message, Throwable cause, boolean enableSuppression, boolean writableStackTrace) {
		super(message, cause, enableSuppression, writableStackTrace);
	}

	public DaoInputException(String message, Throwable cause) {
		super(message, cause);
	}

	public DaoInputException(String message) {
		super(message);
	}

	public DaoInputException(Throwable cause) {
		super(cause);
	}

	/**
	 *
	 */
	private static final long serialVersionUID = 6314518364265215648L;

}
