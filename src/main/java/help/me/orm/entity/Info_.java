package help.me.orm.entity;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2015-11-26T18:29:50.411-0800")
@StaticMetamodel(Info.class)
public class Info_ {
	public static volatile SingularAttribute<Info, Integer> infoId;
	public static volatile SingularAttribute<Info, String> address;
	public static volatile SingularAttribute<Info, String> city;
	public static volatile SingularAttribute<Info, String> zipcode;
	public static volatile SingularAttribute<Info, String> phoneNumber;
	public static volatile SingularAttribute<Info, Boolean> phoneOk;
	public static volatile SingularAttribute<Info, Boolean> textOk;
	public static volatile SingularAttribute<Info, Boolean> emailOk;
	public static volatile SingularAttribute<Info, Date> createdAt;
	public static volatile SingularAttribute<Info, Date> updatedAt;
	public static volatile SingularAttribute<Info, User> user;
}
